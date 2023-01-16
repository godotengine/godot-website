---
title: "Fixing Godot games published in Google Play"
excerpt: "After games being published using Godot on Google Play for almost 8 years with no problems, Google decided they don't like the format we use for exporting any more and is suspending many published games. Here's how to fix your APK to upload it again."
categories: ["news"]
author: Juan Linietsky
image: /storage/app/uploads/public/5b0/801/a45/5b0801a4507a7324391341.png
date: 2018-05-25 00:00:00
---

After games being published using Godot on Google Play for almost 8 years with no problems, Google decided they don't like the format we use for exporting any more and is suspending many published games.

The problem comes from Godot using placeholder permissions in the APK, which are replaced by real permissions on export. Google never really had a problem with this approach, and I made sure to talk to Google representatives years ago to make sure this was not a problem.

At some point, it seems they changed their mind and started removing already published games. We got in contact with them to see if it can be solved from their end, but in the meantime we are publishing this guide that explains how to solve the problem manually.

## How to fix it

A new 2.1 release is coming along to fix this problem (and Godot 3.1 will use a different approach to exporting which should comply more with Google). In the meantime, we'll give you the necessary steps to fix your game in two possible situations:

- A) You use Godot 2.1.x and don't need any specific Android permissions: We've built a new 2.1.4-stable template with all placeholder permissions removed, so you can use it as custom template to export your game.
- B) You need specific Android permissions, you usually build your own template to include thirdparty modules, or you are using Godot 3.0 or later: You will have to build from source and edit the Android manifest yourself.
- C) Use our [Godot APK fixer tool](https://godotengine.org/article/godot-apk-fixer-tool) on an already exported game. This will work for 2.x and 3.x exported APKs.

Details for each situation are given below.

### A) Using a custom "no permissions" template

If your game does not require any specific permissions from Android, and you don't need to build your own template for thirdparty modules, you can simply reexport your game using the new "no permissions" template that we uploaded today for Godot 2.1.4-stable:

- Release "no-perms" template: https://download.tuxfamily.org/godotengine/2.1.4/android_release-no_perms.apk
- Debug "no-perms" template: https://download.tuxfamily.org/godotengine/2.1.4/android_debug-no_perms.apk

You can download those APKs and set them as "Custom Package" in the export manager. They will be used as templates when exporting your project.

![Custom Package in Godot 2.1.4](/storage/app/uploads/public/5b0/812/cb2/5b0812cb2680c963456756.png)

Note: If you *do* tick some specific permissions in the export manager while using this template, they will be ignored.

### B) Building from source and editing the manifest

##### 1. Download Godot source code from [GitHub](https://github.com/godotengine/godot)

If your game uses Godot 2.1 or 3.0 stable, make sure to change the branch accordingly:

![Godot branches on GitHub](/storage/app/media/branch.png)

##### 2. Modify the manifest template

Edit the manifest template, which is at:

`godot/platform/android/AndroidManifest.xml.template`


Remove the permission placeholders:

```
<uses-permission android:name="godot.ACCESS_CHECKIN_PROPERTIES"/>
<uses-permission android:name="godot.ACCESS_COARSE_LOCATION"/>
<uses-permission android:name="godot.ACCESS_FINE_LOCATION"/>
<uses-permission android:name="godot.ACCESS_LOCATION_EXTRA_COMMANDS"/>
<uses-permission android:name="godot.ACCESS_MOCK_LOCATION"/>
<uses-permission android:name="godot.ACCESS_NETWORK_STATE"/>
<uses-permission android:name="godot.ACCESS_SURFACE_FLINGER"/>
<uses-permission android:name="godot.ACCESS_WIFI_STATE"/>
<uses-permission android:name="godot.ACCOUNT_MANAGER"/>
<uses-permission android:name="godot.ADD_VOICEMAIL"/>
<uses-permission android:name="godot.AUTHENTICATE_ACCOUNTS"/>
<uses-permission android:name="godot.BATTERY_STATS"/>
<uses-permission android:name="godot.BIND_ACCESSIBILITY_SERVICE"/>
<uses-permission android:name="godot.BIND_APPWIDGET"/>
<uses-permission android:name="godot.BIND_DEVICE_ADMIN"/>
<uses-permission android:name="godot.BIND_INPUT_METHOD"/>
<uses-permission android:name="godot.BIND_NFC_SERVICE"/>
<uses-permission android:name="godot.BIND_NOTIFICATION_LISTENER_SERVICE"/>
<uses-permission android:name="godot.BIND_PRINT_SERVICE"/>
<uses-permission android:name="godot.BIND_REMOTEVIEWS"/>
<uses-permission android:name="godot.BIND_TEXT_SERVICE"/>
<uses-permission android:name="godot.BIND_VPN_SERVICE"/>
<uses-permission android:name="godot.BIND_WALLPAPER"/>
<uses-permission android:name="godot.BLUETOOTH"/>
<uses-permission android:name="godot.BLUETOOTH_ADMIN"/>
<uses-permission android:name="godot.BLUETOOTH_PRIVILEGED"/>
<uses-permission android:name="godot.BRICK"/>
<uses-permission android:name="godot.BROADCAST_PACKAGE_REMOVED"/>
<uses-permission android:name="godot.BROADCAST_SMS"/>
<uses-permission android:name="godot.BROADCAST_STICKY"/>
<uses-permission android:name="godot.BROADCAST_WAP_PUSH"/>
<uses-permission android:name="godot.CALL_PHONE"/>
<uses-permission android:name="godot.CALL_PRIVILEGED"/>
<uses-permission android:name="godot.CAMERA"/>
<uses-permission android:name="godot.CAPTURE_AUDIO_OUTPUT"/>
<uses-permission android:name="godot.CAPTURE_SECURE_VIDEO_OUTPUT"/>
<uses-permission android:name="godot.CAPTURE_VIDEO_OUTPUT"/>
<uses-permission android:name="godot.CHANGE_COMPONENT_ENABLED_STATE"/>
<uses-permission android:name="godot.CHANGE_CONFIGURATION"/>
<uses-permission android:name="godot.CHANGE_NETWORK_STATE"/>
<uses-permission android:name="godot.CHANGE_WIFI_MULTICAST_STATE"/>
<uses-permission android:name="godot.CHANGE_WIFI_STATE"/>
<uses-permission android:name="godot.CLEAR_APP_CACHE"/>
<uses-permission android:name="godot.CLEAR_APP_USER_DATA"/>
<uses-permission android:name="godot.CONTROL_LOCATION_UPDATES"/>
<uses-permission android:name="godot.DELETE_CACHE_FILES"/>
<uses-permission android:name="godot.DELETE_PACKAGES"/>
<uses-permission android:name="godot.DEVICE_POWER"/>
<uses-permission android:name="godot.DIAGNOSTIC"/>
<uses-permission android:name="godot.DISABLE_KEYGUARD"/>
<uses-permission android:name="godot.DUMP"/>
<uses-permission android:name="godot.EXPAND_STATUS_BAR"/>
<uses-permission android:name="godot.FACTORY_TEST"/>
<uses-permission android:name="godot.FLASHLIGHT"/>
<uses-permission android:name="godot.FORCE_BACK"/>
<uses-permission android:name="godot.GET_ACCOUNTS"/>
<uses-permission android:name="godot.GET_PACKAGE_SIZE"/>
<uses-permission android:name="godot.GET_TASKS"/>
<uses-permission android:name="godot.GET_TOP_ACTIVITY_INFO"/>
<uses-permission android:name="godot.GLOBAL_SEARCH"/>
<uses-permission android:name="godot.HARDWARE_TEST"/>
<uses-permission android:name="godot.INJECT_EVENTS"/>
<uses-permission android:name="godot.INSTALL_LOCATION_PROVIDER"/>
<uses-permission android:name="godot.INSTALL_PACKAGES"/>
<uses-permission android:name="godot.INSTALL_SHORTCUT"/>
<uses-permission android:name="godot.INTERNAL_SYSTEM_WINDOW"/>
<uses-permission android:name="godot.INTERNET"/>
<uses-permission android:name="godot.KILL_BACKGROUND_PROCESSES"/>
<uses-permission android:name="godot.LOCATION_HARDWARE"/>
<uses-permission android:name="godot.MANAGE_ACCOUNTS"/>
<uses-permission android:name="godot.MANAGE_APP_TOKENS"/>
<uses-permission android:name="godot.MANAGE_DOCUMENTS"/>
<uses-permission android:name="godot.MASTER_CLEAR"/>
<uses-permission android:name="godot.MEDIA_CONTENT_CONTROL"/>
<uses-permission android:name="godot.MODIFY_AUDIO_SETTINGS"/>
<uses-permission android:name="godot.MODIFY_PHONE_STATE"/>
<uses-permission android:name="godot.MOUNT_FORMAT_FILESYSTEMS"/>
<uses-permission android:name="godot.MOUNT_UNMOUNT_FILESYSTEMS"/>
<uses-permission android:name="godot.NFC"/>
<uses-permission android:name="godot.PERSISTENT_ACTIVITY"/>
<uses-permission android:name="godot.PROCESS_OUTGOING_CALLS"/>
<uses-permission android:name="godot.READ_CALENDAR"/>
<uses-permission android:name="godot.READ_CALL_LOG"/>
<uses-permission android:name="godot.READ_CONTACTS"/>
<uses-permission android:name="godot.READ_EXTERNAL_STORAGE"/>
<uses-permission android:name="godot.READ_FRAME_BUFFER"/>
<uses-permission android:name="godot.READ_HISTORY_BOOKMARKS"/>
<uses-permission android:name="godot.READ_INPUT_STATE"/>
<uses-permission android:name="godot.READ_LOGS"/>
<uses-permission android:name="godot.READ_PHONE_STATE"/>
<uses-permission android:name="godot.READ_PROFILE"/>
<uses-permission android:name="godot.READ_SMS"/>
<uses-permission android:name="godot.READ_SOCIAL_STREAM"/>
<uses-permission android:name="godot.READ_SYNC_SETTINGS"/>
<uses-permission android:name="godot.READ_SYNC_STATS"/>
<uses-permission android:name="godot.READ_USER_DICTIONARY"/>
<uses-permission android:name="godot.REBOOT"/>
<uses-permission android:name="godot.RECEIVE_BOOT_COMPLETED"/>
<uses-permission android:name="godot.RECEIVE_MMS"/>
<uses-permission android:name="godot.RECEIVE_SMS"/>
<uses-permission android:name="godot.RECEIVE_WAP_PUSH"/>
<uses-permission android:name="godot.RECORD_AUDIO"/>
<uses-permission android:name="godot.REORDER_TASKS"/>
<uses-permission android:name="godot.RESTART_PACKAGES"/>
<uses-permission android:name="godot.SEND_RESPOND_VIA_MESSAGE"/>
<uses-permission android:name="godot.SEND_SMS"/>
<uses-permission android:name="godot.SET_ACTIVITY_WATCHER"/>
<uses-permission android:name="godot.SET_ALARM"/>
<uses-permission android:name="godot.SET_ALWAYS_FINISH"/>
<uses-permission android:name="godot.SET_ANIMATION_SCALE"/>
<uses-permission android:name="godot.SET_DEBUG_APP"/>
<uses-permission android:name="godot.SET_ORIENTATION"/>
<uses-permission android:name="godot.SET_POINTER_SPEED"/>
<uses-permission android:name="godot.SET_PREFERRED_APPLICATIONS"/>
<uses-permission android:name="godot.SET_PROCESS_LIMIT"/>
<uses-permission android:name="godot.SET_TIME"/>
<uses-permission android:name="godot.SET_TIME_ZONE"/>
<uses-permission android:name="godot.SET_WALLPAPER"/>
<uses-permission android:name="godot.SET_WALLPAPER_HINTS"/>
<uses-permission android:name="godot.SIGNAL_PERSISTENT_PROCESSES"/>
<uses-permission android:name="godot.STATUS_BAR"/>
<uses-permission android:name="godot.SUBSCRIBED_FEEDS_READ"/>
<uses-permission android:name="godot.SUBSCRIBED_FEEDS_WRITE"/>
<uses-permission android:name="godot.SYSTEM_ALERT_WINDOW"/>
<uses-permission android:name="godot.TRANSMIT_IR"/>
<uses-permission android:name="godot.UNINSTALL_SHORTCUT"/>
<uses-permission android:name="godot.UPDATE_DEVICE_STATS"/>
<uses-permission android:name="godot.USE_CREDENTIALS"/>
<uses-permission android:name="godot.USE_SIP"/>
<uses-permission android:name="godot.VIBRATE"/>
<uses-permission android:name="godot.WAKE_LOCK"/>
<uses-permission android:name="godot.WRITE_APN_SETTINGS"/>
<uses-permission android:name="godot.WRITE_CALENDAR"/>
<uses-permission android:name="godot.WRITE_CALL_LOG"/>
<uses-permission android:name="godot.WRITE_CONTACTS"/>
<uses-permission android:name="godot.WRITE_EXTERNAL_STORAGE"/>
<uses-permission android:name="godot.WRITE_GSERVICES"/>
<uses-permission android:name="godot.WRITE_HISTORY_BOOKMARKS"/>
<uses-permission android:name="godot.WRITE_PROFILE"/>
<uses-permission android:name="godot.WRITE_SECURE_SETTINGS"/>
<uses-permission android:name="godot.WRITE_SETTINGS"/>
<uses-permission android:name="godot.WRITE_SMS"/>
<uses-permission android:name="godot.WRITE_SOCIAL_STREAM"/>
<uses-permission android:name="godot.WRITE_SYNC_SETTINGS"/>
<uses-permission android:name="godot.WRITE_USER_DICTIONARY"/>
<uses-permission android:name="godot.custom.0"/>
<uses-permission android:name="godot.custom.1"/>
<uses-permission android:name="godot.custom.2"/>
<uses-permission android:name="godot.custom.3"/>
<uses-permission android:name="godot.custom.4"/>
<uses-permission android:name="godot.custom.5"/>
<uses-permission android:name="godot.custom.6"/>
<uses-permission android:name="godot.custom.7"/>
<uses-permission android:name="godot.custom.8"/>
<uses-permission android:name="godot.custom.9"/>
<uses-permission android:name="godot.custom.10"/>
<uses-permission android:name="godot.custom.11"/>
<uses-permission android:name="godot.custom.12"/>
<uses-permission android:name="godot.custom.13"/>
<uses-permission android:name="godot.custom.14"/>
<uses-permission android:name="godot.custom.15"/>
<uses-permission android:name="godot.custom.16"/>
<uses-permission android:name="godot.custom.17"/>
<uses-permission android:name="godot.custom.18"/>
<uses-permission android:name="godot.custom.19"/>
```

Replace them by the actual permissions used by your game: [https://developer.android.com/guide/topics/permissions/overview](https://developer.android.com/guide/topics/permissions/overview)


##### 3. Compile the android templates

There are instructions on how to do this for [Godot 2](http://docs.godotengine.org/en/2.1/development/compiling/compiling_for_android.html) and [Godot 3](http://docs.godotengine.org/en/3.0/development/compiling/compiling_for_android.html).


##### 4. Set your new APKs as custom export templates

In the export settings for Android, set the custom debug and release APKs generated by Gradle and use those. This should fix the problem.


##### 5. If needed, add a privacy policy

The reason why Google removed Godot games from their store is that they were using placeholder permissions *looking like* normal permissions, without having a privacy policy telling users how potentially collected data is being used.

If you don't add any permission that justifies it, you don't need a privacy policy, but if you do, make sure to write one. Refer to the Google documentation/emails they might have sent you for details about this.


## Future

[HP/TMM](https://github.com/hpvb) is working on a fix to to be integrated in Godot 2.1.5 and Godot 3.0.3 so that you can continue setting the permissions you want without having those leftover placeholders.

Godot 3.1 will use a different export approach where you will have more control over the manifest file.

Apologies for the inconvenience.
