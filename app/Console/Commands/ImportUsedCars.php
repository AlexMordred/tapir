<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Car;
use App\Make;
use App\Model;

class ImportUsedCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:used-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $xmlString = Storage::get('data.xml');

        $xml = simplexml_load_string($xmlString);

        foreach ($xml->children() as $car) {
            $this->parseCar($car);
        }
    }

    protected function parseCar($car)
    {
        $array = (array)$car;

        if (Car::where('data_id', $array['id'])->exists()) {
            return;
        }

        $make = $this->getMake($array['Make']);
        $model = $this->getModel($make, $array['Model']);

        Car::create([
            'data_id' => $array['id'],
            'make_id' => $make->id,
            'model_id' => $model->id,
            'price' => $this->parseValue($array, 'Price'),
            'kilometrage' => $this->parseValue($array, 'Kilometrage'),
            'accident' => $this->parseValue($array, 'Accident'),
            'year' => $this->parseValue($array, 'Year'),
            'body_type' => $this->parseValue($array, 'BodyType'),
            'doors' => $this->parseValue($array, 'Doors'),
            'color' => $this->parseValue($array, 'Color'),
            'fuel_type' => $this->parseValue($array, 'FuelType'),
            'engine_size' => $this->parseValue($array, 'EngineSize'),
            'power' => $this->parseValue($array, 'Power'),
            'transmission' => $this->parseValue($array, 'Transmission'),
            'drive_type' => $this->parseValue($array, 'DriveType'),
            'wheel_type' => $this->parseValue($array, 'WheelType'),
            'power_steering' => $this->parseValue($array, 'PowerSteering'),
            'climate_control' => $this->parseValue($array, 'ClimateControl'),
            'interior' => $this->parseValue($array, 'Interior'),
            'interior_options' => $this->parseOptions($car->InteriorOptions),
            'interior_options' => $this->parseOptions($car->Heating),
            'power_windows' => $this->parseValue($array, 'PowerWindows'),
            'electric_drive' => $this->parseOptions($car->ElectricDrive),
            'memory_settings' => $this->parseOptions($car->MemorySettings),
            'driving_assistance' => $this->parseOptions($car->DrivingAssistance),
            'antitheft_system' => $this->parseOptions($car->AntitheftSystem),
            'airbags' => $this->parseOptions($car->Airbags),
            'active_safety' => $this->parseOptions($car->ActiveSafety),
            'multimedia' => $this->parseOptions($car->Multimedia),
            'wheels' => $this->parseValue($array, 'Wheels'),
            'owners' => $this->parseValue($array, 'Owners'),
            'images' => $this->parseImages($car->Images),
        ]);
    }

    protected function parseValue($array, $key)
    {
        return isset($array[$key]) ? $array[$key] : null;
    }

    protected function parseOptions($options)
    {
        $result = [];
        $options = (array) $options;

        foreach ($options as $option) {
            $option = (array) $option;

            array_push($result, $option[0]);
        }

        return json_encode($result);
    }

    protected function parseImages($options)
    {
        $result = [];
        $options = ((array) $options)['Image'];

        foreach ($options as $option) {
            $option = (array)$option;

            array_push($result, $option['@attributes']['url']);
        }

        return json_encode($result);
    }

    protected function getMake($name)
    {
        return Make::firstOrCreate(['name' => $name]);
    }

    protected function getModel($make, $name)
    {
        return Model::firstOrCreate([
            'make_id' => $make->id,
            'name' => $name,
        ]);
    }
}
