<?php namespace RainLab\Translate\Models;

use Backend\Models\ImportModel;

class MessageImport extends ImportModel
{

    public $rules = [
        'code' => 'required'
    ];

    /**
     * Import the message data from a csv with the following schema:
     *
     * code  | en    | de    | fr
     * -------------------------------
     * title | Title | Titel | Titre
     * name  | Name  | Name  | Prénom
     * ...
     *
     * The code column is required and must not be empty.
     *
     * Note: Messages with an existing code are not removed/touched if the import
     * doesn't contain this code. As a result you can incrementally update the
     * messages by just adding the new codes and messages to the csv.
     *
     * @param $results
     * @param null $sessionKey
     */
    public function importData($results, $sessionKey = null)
    {
        $codeName = MessageExport::CODE_COLUMN_NAME;

        foreach ($results as $index => $result) {
            try {
                if (isset($result[$codeName]) && !empty($result[$codeName])) {
                    $code = $result[$codeName];

                    // Modify result to match the expected message_data schema
                    unset($result[$codeName]);

                    $message = Message::firstOrNew(['code' => $code]);

                    // Create empty array, if $message is new
                    $message->message_data = $message->message_data ?: [];

                    if(!isset($message->message_data[Message::DEFAULT_LOCALE])) {
                        $result[Message::DEFAULT_LOCALE] = $code;
                    }

                    $message->message_data = array_merge($message->message_data, $result);

                    if ($message->exists) {
                        $this->logUpdated();
                    } else {
                        $this->logCreated();
                    }

                    $message->save();

                } else {
                    $this->logSkipped($index, 'No code provided');
                }
            } catch (\Exception $exception) {
                $this->logError($index, $exception->getMessage());
            }
        }
    }

}
