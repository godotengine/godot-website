<?php namespace RainLab\Translate\Tests\Unit\Behaviors;

use File;
use October\Rain\Halcyon\Model;
use October\Rain\Filesystem\Filesystem;
use October\Rain\Halcyon\Datasource\FileDatasource;
use October\Rain\Halcyon\Datasource\Resolver;
use RainLab\Translate\Tests\Fixtures\Classes\Feature as FeatureModel;
use RainLab\Translate\Models\Locale as LocaleModel;
use PluginTestCase;

class TranslatableCmsObjectTest extends PluginTestCase
{
    public $themePath;

    public function setUp()
    {
        parent::setUp();

        $this->themePath = __DIR__ . '/../../fixtures/themes/test';

        $this->seedSampleSourceAndData();
    }

    public function tearDown()
    {
        $this->cleanUp();
    }

    protected function cleanUp()
    {
        @unlink($this->themePath.'/features/winning.htm');
        @unlink($this->themePath.'/features-fr/winning.htm');
        File::deleteDirectory($this->themePath.'/features');
        File::deleteDirectory($this->themePath.'/features-fr');
    }

    protected function seedSampleSourceAndData()
    {
        $datasource = new FileDatasource($this->themePath, new Filesystem);
        $resolver = new Resolver(['theme1' => $datasource]);
        $resolver->setDefaultDatasource('theme1');
        Model::setDatasourceResolver($resolver);

        LocaleModel::unguard();

        LocaleModel::firstOrCreate([
            'code' => 'fr',
            'name' => 'French',
            'is_enabled' => 1
        ]);

        LocaleModel::reguard();

        $this->recycleSampleData();
    }

    protected function recycleSampleData()
    {
        $this->cleanUp();

        FeatureModel::create([
            'fileName' => 'winning.htm',
            'settings' => ['title' => 'Hash tag winning'],
            'markup' => 'Awww yiss',
        ]);
    }

    public function testGetTranslationValue()
    {
        $obj = FeatureModel::first();

        $this->assertEquals('Awww yiss', $obj->markup);

        $obj->translateContext('fr');

        $this->assertEquals('Awww yiss', $obj->markup);
    }

    public function testGetTranslationValueNoFallback()
    {
        $obj = FeatureModel::first();

        $this->assertEquals('Awww yiss', $obj->markup);

        $obj->noFallbackLocale()->translateContext('fr');

        $this->assertEquals(null, $obj->markup);
    }

    public function testSetTranslationValue()
    {
        $this->recycleSampleData();

        $obj = FeatureModel::first();
        $obj->markup = 'Aussie';
        $obj->save();

        $obj->translateContext('fr');
        $obj->markup = 'Australie';
        $obj->save();

        $obj = FeatureModel::first();
        $this->assertEquals('Aussie', $obj->markup);

        $obj->translateContext('fr');
        $this->assertEquals('Australie', $obj->markup);
    }

}
