<?php

/**
* @file
* Contains \Drupal\social_demo\SocialDemoFile.
*/

namespace Drupal\social_demo\Content;

/*
 * Social Demo Content File.
 */

use Drupal\file\Entity\File;
use Drupal\social_demo\Yaml\SocialDemoParser;

class SocialDemoFile {

  private $files;

  /*
   * Read file contents on construction.
   */
  public function __construct() {
    $yml_data = new SocialDemoParser();
    $this->files = $yml_data->parseFile('entity/file.yml');
  }

  public static function create() {
    return new static();
  }

  /*
   * Function to create content.
   */
  public function createContent() {

    $content_counter = 0;

    // Loop through the content and try to create new entries.
    foreach($this->files as $uuid => $file) {
      // Must have uuid and same key value.
      if ($uuid !== $file['uuid']) {
        var_dump('File with uuid: ' . $uuid . ' has a different uuid in content.');
        continue;
      }

      // Try and fetch the user.
      $container = \Drupal::getContainer();
      $accountClass = SocialDemoUser::create($container);
      $uid = $accountClass->loadUserFromUuid($file['uid']);

      $uri  = file_unmanaged_copy('/root/dev-scripts/content/files/'.$file['filename'], 'public://' . $file['filename'], FILE_EXISTS_REPLACE);

      $media = File::create([
        'uuid' => $file['uuid'],
        'langcode' => $file['langcode'],
        'uid' => $uid,
        'status' => $file['status'],
        'uri' => $uri
      ]);
      $media->save();

      $content_counter++;
    }

    return $content_counter;
  }

  /*
   * Function to remove content.
   */
  public function removeContent() {
    // Loop through the content and try to create new entries.
    foreach($this->files as $uuid => $file) {

      // Must have uuid and same key value.
      if ($uuid !== $file['uuid']) {
        continue;
      }

      // Load the nodes from the uuid.
      $fid = $this->loadByUuid($uuid);
      // Load the file object.
      if ($file = File::load($fid)) {
        $file->delete();
      }
    }
  }

  /**
   * Load a file object by uuid.
   *
   * @param $uuid
   *  the uuid of the file.
   *
   * @return int $fid
   */
  public function loadByUuid($uuid) {
    $query = \Drupal::entityQuery('file');
    $query->condition('uuid', $uuid);
    $fids = $query->execute();
    // Get a single item
    $fid = reset($fids);
    // And return it.
    return $fid;
  }

}
