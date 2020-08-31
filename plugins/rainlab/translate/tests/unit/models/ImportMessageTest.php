<?php namespace RainLab\Translate\Tests\Unit\Models;

use PluginTestCase;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Models\MessageImport;

class ImportMessageTest extends PluginTestCase
{
    public function testCanHandleEmptyImport()
    {
        $messageImport = new MessageImport();
        $data = [];

        $messageImport->importData($data);

        $stats = $messageImport->getResultStats();
        $this->assertEquals(false, $stats->hasMessages);
    }

    public function testCreateMessage()
    {
        $messageImport = new MessageImport();
        $data = [
            ['code' => 'new', 'de' => 'Neu', 'en' => 'new']
        ];

        $messageImport->importData($data);

        $stats = $messageImport->getResultStats();
        $this->assertEquals(1, $stats->created);
        $this->assertEquals(0, $stats->updated);
        $this->assertEquals(0, $stats->skippedCount);
        $this->assertEquals(false, $stats->hasMessages);
    }

    public function testUpdateMessage()
    {
        $messageImport = new MessageImport();
        Message::create(['code' => 'update', 'message_data' => ['en' => 'update', 'de' => 'aktualisieren']]);
        $data = [
            ['code' => 'update', 'de' => 'Neu 2', 'en' => 'new 2']
        ];
        $expected = [
            Message::DEFAULT_LOCALE => 'update', 'de' => 'Neu 2', 'en' => 'new 2'
        ];

        $messageImport->importData($data);

        $stats = $messageImport->getResultStats();
        $this->assertEquals(0, $stats->created);
        $this->assertEquals(1, $stats->updated);
        $this->assertEquals(0, $stats->skippedCount);
        $this->assertEquals(false, $stats->hasMessages);
        $updatedMessage = Message::whereCode('update')->first();
        $this->assertEquals($expected, $updatedMessage->message_data);
    }

    public function testMissingCodeIsSkipped()
    {
        $messageImport = new MessageImport();
        $data = [
            ['de' => 'Neu 2', 'en' => 'new 2']
        ];

        $messageImport->importData($data);

        $stats = $messageImport->getResultStats();
        $this->assertEquals(0, $stats->created);
        $this->assertEquals(0, $stats->updated);
        $this->assertEquals(1, $stats->skippedCount);
        $this->assertEquals(true, $stats->hasMessages);
        $this->assertEquals(Message::count(), 0);
    }
}