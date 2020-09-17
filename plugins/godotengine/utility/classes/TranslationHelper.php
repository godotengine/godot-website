<?php

namespace GodotEngine\Utility\Classes;

class TranslationHelper
{
  public static function generateTranslationKey($messageId)
  {
      $separator = '.';
      // The plugin limits keys to 250 charaters, but database doesn't allow it.
      // May be a local bug, but to be sure we will limit it to be even shorter.
      $characterLimit = 150;

      // Convert all dashes/underscores into separator.
      $messageId = preg_replace('!['.preg_quote('_').'|'.preg_quote('-').']+!u', $separator, $messageId);

      // Remove all characters that are not the separator, letters, numbers, or whitespace.
      $messageId = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($messageId));

      // Replace all separator characters and whitespace by a single separator.
      $messageId = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $messageId);

      // Trim unnecessary characters.
      $messageId = trim($messageId, $separator);

      // If the message is too long, crop it to fit the database column.
      $messageLen = strlen($messageId);
      if ($messageLen > $characterLimit) {
          // We also add a number of characters left to increase uniqueness.
          $messageId = substr($messageId, 0, $characterLimit) . '.' . ($messageLen - $characterLimit);
      }

      return $messageId;
  }
}