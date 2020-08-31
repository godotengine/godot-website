<?php namespace RainLab\Translate\Tests\Unit\Models;

use PluginTestCase;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Models\MessageExport;

class ExportMessageTest extends PluginTestCase
{

    public function testCanHandleNoMessages()
    {
        $exportModel = new MessageExport();
        $expected = [];

        $result = $exportModel->exportData([]);

        $this->assertEquals($expected, $result);
    }

    public function testCanHandleNoColumn()
    {
        $exportModel = new MessageExport();
        $this->createMessages();
        $expected = [[], []];

        $result = $exportModel->exportData([]);

        $this->assertEquals($expected, $result);
    }

    public function testExportSomeColumns()
    {
        $exportMode = new MessageExport();
        $this->createMessages();
        $expected = [
            ['code' => 'hello'],
            ['code' => 'bye'],
        ];

        $result = $exportMode->exportData(['code']);

        $this->assertEquals($expected, $result);
    }

    public function testExportAllColumns()
    {
        $exportMode = new MessageExport();
        $this->createMessages();
        $expected = [
            ['code' => 'hello', 'de' => 'Hallo, Welt', 'en' => 'Hello, World'],
            ['code' => 'bye', 'de' => 'Auf Wiedersehen', 'en' => 'Goodbye'],
        ];

        $result = $exportMode->exportData(['code', 'de', 'en']);

        $this->assertEquals($expected, $result);
    }

    public function testCanHandleNonExistingColumns()
    {
        $exportMode = new MessageExport();
        $this->createMessages();
        $expected = [
            ['dummy' => ''],
            ['dummy' => ''],
        ];

        $result = $exportMode->exportData(['dummy']);

        $this->assertEquals($expected, $result);
    }

    private function createMessages()
    {
        Message::create([
            'code' => 'hello', 'message_data' => ['de' => 'Hallo, Welt', 'en' => 'Hello, World']
        ]);
        Message::create([
            'code' => 'bye', 'message_data' => ['de' => 'Auf Wiedersehen', 'en' => 'Goodbye']
        ]);
    }

}