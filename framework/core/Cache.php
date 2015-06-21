<?php
/**
 * ███████╗██╗   ██╗ ██████╗ ██╗    ██╗   ██╗███████╗
 * ██╔════╝██║   ██║██╔═══██╗██║    ██║   ██║██╔════╝
 * █████╗  ██║   ██║██║   ██║██║    ██║   ██║█████╗
 * ██╔══╝  ╚██╗ ██╔╝██║   ██║██║    ╚██╗ ██╔╝██╔══╝
 * ███████╗ ╚████╔╝ ╚██████╔╝███████╗╚████╔╝ ███████╗
 * ╚══════╝  ╚═══╝   ╚═════╝ ╚══════╝ ╚═══╝  ╚══════╝
 *
 * Evolve Framework
 * Copyright (c) Vojtěch Hutla, Marian Abaffy
 *
 * Licensed under MIT
 * evolve.github.io
 */

class Cache {
  /**
   * @var Directory with cached files
   */
  private $cache_dir;

  /**
   * @var Cached files index
   */
  private $cache_index;

  /**
   * @var Time when cache will be invalid
   */
  private $cache_devalidate;

  /**
   * @var Cache index as array
   */
  private $index_array;

  /**
   * Construct cache class - load environment constants
   */
   public function __construct() {
     $this->cache_dir = EVOLVE_CACHEDIR.'/Cached';
     $this->cache_index = EVOLVE_CACHEDIR.'/CacheIndex.json';
     $this->cache_devalidate = '86400';
     $this->index_array = self::getCachedList($this->cache_index);
   }

   /**
    * Get cached file
    * @param name of file
    */
   public function read($name) {
     if(isset($this->index_array[$name])) {
       /* Cached file is indexed */
       $cached_file_info = $this->index_array[$name];
       if(file_exists($this->cache_dir.'/'.$cached_file_info['hash'])) {
         if(time() <= $cached_file_info['devalidate']) {
           return file_get_contents($this->cache_dir.'/'.$cached_file_info['hash']);
         } else {
           $this->delete($name);
           return 'cache_invalid';
         }
       } else {
         return 'cache_not_exists';
       }
     } else {
       return 'cache_not_exists';
     }
   }

   /**
    * Cache new file
    * @param name of file
    * @param cache content
    */
   public function write($name,$content) {
     if(isset($this->index_array[$name])) {
       $this->delete($name);
     }

     $hash = sha1(time().rand(1000,9999));
     $this->index_array[$name] = array('hash' => $hash, 'devalidate' => time() + $this->cache_devalidate);

     $file = fopen($this->cache_dir.'/'.$hash,'w');
     fwrite($file,$content);
     fclose($file);

     self::saveCachedList($this->index_array,$this->cache_index);
   }

   /**
    * Make cache invalid
    * @param name of cache to invalidate
    */
   public function delete($name) {
     unlink($this->cache_dir.'/'.$this->index_array[$name]['hash']);
     unset($this->index_array[$name]);
     self::saveCachedList($this->index_array,$this->cache_index);
   }

   /**
    * Get list of cached files
    */
   protected static function getCachedList($index_file) {
     return json_decode(file_get_contents($index_file),TRUE);
   }

   /**
    * Update cache list
    */
   protected static function saveCachedList($index,$index_file) {
     $file = fopen($index_file,'w');
     fwrite($file,json_encode($index,JSON_PRETTY_PRINT));
     fclose($file);
   }
}
