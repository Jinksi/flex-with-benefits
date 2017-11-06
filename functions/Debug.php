<?php
function cl ($data) {
  echo '<script>';
  echo 'console.log('. json_encode(  $data ) .')';
  echo '</script>';
}

class Debug {
  const QUIT = '/*/**/**\\*\\';
  const MODE_PRINT = 1;
  const MODE_LOG = 2;
  const MODE_HIDE = 3;

  public static $mode = self::MODE_PRINT;
  private static $_time = array();
  private static $_dumpToFileDate = '';

  /**
  * Dumps any sort of data as long as the first parameter is true.
  * To use: Debug::dumpIf(get_class($this)=='News',$date,$revisionId);
  * Behaves just like self::dump
  */
  public static function init() {
    $scriptDirectory = dirname(dirname(__FILE__));
    define('BASEDIR', $scriptDirectory . '/');
    define('LOGDIR', dirname(BASEDIR) . '/log/');
  }

  public static function dumpIf() {
    $args = func_get_args();
    if (!isset($args[0]) || $args[0] == false) {
      return;
    }
    array_shift($args);
    call_user_func_array(array('self', 'dump'), $args);
  }

  /**
  * Dumps any sort of data
  *
  * @param <type> $data
  */
  public static function dump($data) {
    if (func_num_args() == 0) {
      if (self::$mode === self::MODE_PRINT) {
        echo self::findFrom(debug_backtrace());
      } else if (self::$mode === self::MODE_LOG) {
        // please implment
      }
      return;
    }
    if (self::$mode === self::MODE_PRINT) {
      echo '<pre style="' . self::getDebugStyle() . '">';
      foreach (func_get_args() as $arg) {
        if ($arg === self::QUIT) {
          echo self::findFrom(debug_backtrace());
          die(' Debug called for QUIT');
        }
        if (is_string($arg)) {
          echo htmlentities($arg);
          echo '<br />';
        } else {
          var_dump($arg);
        }
      }
      echo self::findFrom(debug_backtrace());
      echo '</pre>';
    } else if (self::$mode === self::MODE_LOG) {
      // please implment
    }
  }

  public static function dumpDie() {
    if (func_num_args() == 0) {
      if (self::$mode === self::MODE_PRINT) {
        echo self::findFrom(debug_backtrace());
      } else if (self::$mode === self::MODE_LOG) {
        // please implment
      }
      return;
    }
    if (self::$mode === self::MODE_PRINT) {
      echo '<pre style="' . self::getDebugStyle() . '">';
      foreach (func_get_args() as $arg) {
        if (is_string($arg)) {
          echo htmlentities($arg);
          echo '<br />';
        } else {
          var_dump($arg);
        }
      }
      echo self::findFrom(debug_backtrace());
      die(' Debug called for QUIT');
    } else if (self::$mode === self::MODE_LOG) {
      // please implment
    }
  }

  public static function prt() {
    if (func_num_args() == 0) {
      if (self::$mode === self::MODE_PRINT) {
        echo self::findFrom(debug_backtrace());
      } else if (self::$mode === self::MODE_LOG) {
        // please implment
      }
      return;
    }
    if (self::$mode === self::MODE_PRINT) {
      echo '<pre style="' . self::getDebugStyle() . '">';
      foreach (func_get_args() as $arg) {
        if ($arg === self::QUIT) {
          echo self::findFrom(debug_backtrace());
          die(' Debug called for QUIT');
        }
        if (is_string($arg)) {
          echo htmlentities($arg);
          echo '<br />';
        } else {
          $a = print_r($arg, true);
          echo htmlentities($a);
        }
      }
      echo self::findFrom(debug_backtrace());
      echo '</pre>';
    } else if (self::$mode === self::MODE_LOG) {
      // please implment
    }
  }

  public static function prtCl() {
    if (func_num_args() == 0) {
      if (self::$mode === self::MODE_PRINT) {
        echo self::findFrom(debug_backtrace());
      } else if (self::$mode === self::MODE_LOG) {
        // please implment
      }
      return;
    }
    if (self::$mode === self::MODE_PRINT) {
      foreach (func_get_args() as $arg) {
        if ($arg === self::QUIT) {
          echo self::findFrom(debug_backtrace()) . "\n";
          die(' Debug called for QUIT');
        }
        if (is_string($arg)) {
          echo htmlentities($arg);
          echo "\n";
        } else {
          $a = print_r($arg, true);
          echo $a . "\n";
        }
      }
      echo self::findFrom(debug_backtrace()) . "\n";
    } else if (self::$mode === self::MODE_LOG) {
      // please implment
    }
  }

  public static function findFrom($path) {
    if (!isset($path[0])) {
      return 'Dunno what is calling the Debug::dump';
    }
    $file = '';
    $line = '';
    $class = '';
    $idx = 0;

    while ($idx < 10) {
      if (
        isset($path[$idx]['file']) &&
        isset($path[$idx]['line']) &&
        strtolower(basename($path[$idx]['file'])) != 'debug.php'
      ) {
        $file = $path[$idx]['file'];
        $line = $path[$idx]['line'];
        if (isset($path[$idx + 1]['class'])) {
          $class = $path[$idx + 1]['class'];
        }
        break;
      }
      $idx++;
    }
    return 'This is coming from '
    . 'File: ' . $file
    . ', Line: ' . $line . "\nNetBeans:" . $class . '-' . $line . "\n";
  }

  /**
  * Same as self::dump() however only runs for local env + automatically
  * exits
  *
  * @param <type> $data
  * @see dump
  */
  public static function quit() {
    if (ISLOCAL) {
      $func = func_get_args();
      $func[] = self::QUIT;
      call_user_func_array(array('Debug', 'dump'), $func);
    }
  }

  /**
  * Get styling for any debug output
  *
  * @return string
  */
  private static function getDebugStyle() {
    $css = array(
      'background: whitesmoke',
      'color: #111',
      'font-size: 16px',
      'line-height: 1.6',
      'font-family: monospace',
      //'font-weight: bold',
      'padding: 10px',
      'box-sizing: border-box',
      'border: 6px solid rgb(87, 220, 255)',
      'text-align: left',
      'width: 100%',
    );

    return implode(';', $css);
  }

  /**
  * Analyse debug backtrace information
  *
  * @todo if the method name is printPath shouldn't it print by default?
  * @param boolean $print True will print the output, false will only return the array.
  * @return string with print_r representation of the debug backtrace.
  */
  public static function printPath($print = false) {
    $debug = debug_backtrace();
    $ret = array();
    $defaults = array(
      'class',
      'type',
      'function',
    );
    foreach ($debug as $item) {
      foreach ($defaults as $default) {
        if (!isset($item[$default])) {
          $item[$default] = ' [' . $default . ' not set]';
        }
      }
      $ret[] = array(
        'location' => $item['file'] . ', line ' . $item['line'],
        'function' => $item['class'] . $item['type'] . $item['function'],
      );
    }
    if ($print) {
      echo '<pre>' . print_r($ret, true) . '</pre>';
    }
    return $ret;
  }

  /**
  * Outputs a variable to a file. It silently does nothing if an error happens.
  *
  * @param string $file Complete path to a file e.g. /var/lh/fass/public_html to save file to root of public html, this value is available from the constant BASEDIR
  * @param mixed $data The variable being recorded.
  * @param boolean $showDate if the requests should be broken and the date shown, defaults to true (yes).
  * @return void
  */
  public static function dumpToFile($file, $data, $showDate = true) {

    $append = "\n";
    $prepend = "\n";
    if ($showDate) {
      if (self::$_dumpToFileDate != date('Y-m-d H:i:s')) {
        self::$_dumpToFileDate = date('Y-m-d H:i:s');
        $prepend .= "-----------------------------\n" . self::$_dumpToFileDate . "\n";
      }
    }
    file_put_contents($file, $prepend . print_r($data, true) . $append, FILE_APPEND);
  }

  /**
  * Dumps to a file long as the first parameter is true.
  * Behaves just like self::dumpToFile
  */
  public static function dumpToFileIf($cond, $file, $data, $showDate = true) {
    if (!$cond) {
      return;
    }
    self::dumpToFile($file, $data, $showDate);
  }

  /**
  * Intentionally throws a Exception to generate a stack trace by the
  * Exception Handler. Useful to trace your code :)
  *
  * @throws Exception
  */
  public static function trace($quit = false) {
    throw new Exception('Debug: trace exception');
    if ($quit) {
      die('Debug called for QUIT');
    }
  }

  /**
  * start the debug timer
  *
  * @param string $name
  * @return void
  */
  public static function time($name) {
    self::$_time[$name] = microtime(true);
  }

  /**
  * calculate the time difference between when the timer was started & ended,
  * then prints the result to the screen
  *
  * @param string $name
  * @return void
  */
  public static function endTime($name) {
    if (isset(self::$_time[$name])) {
      $start = self::$_time[$name];
      $end = microtime(true);
      $duration = round($end - $start, 4);
      $note = $name . ': ' . $duration . ' seconds';
      self::dump($note);
    }
  }

  public static function here() {
    Debug::dumpDie('here');
  }

  public static function hi() {
    Debug::dump('hi');
  }

  public static function stdOutCl() {
    foreach (func_get_args() as $arg) {
      if ($arg === self::QUIT) {
        fwrite(STDOUT, '[' . date('Y-m-d H:i:s') . '] ' . self::findFrom(debug_backtrace()) . " -> called for quit\r\n");
      }
      if (is_string($arg)) {
        fwrite(STDOUT, '[' . date('Y-m-d H:i:s') . '] ' . $arg . "\r\n");
      }
    }
  }

  public static function logFrom($count = -1) {
    $ret = array();
    $types = array('class', 'type', 'function');
    foreach (debug_backtrace() as $key => $info) {
      $ret[$key] = '';
      foreach ($types as $type) {
        if (isset($info[$type])) {
          $ret[$key] .= $info[$type];
        }
      }
      if (isset($info['line'])) {
        $ret[$key].='/' . $info['line'];
      }
      if ($count != -1 && count($ret) >= $count) {
        break;
      }
    }
    return implode(', ', $ret);
  }


  public static function clLog($msg, $from = 3) {
    if (is_array($msg)) {
      $msg = print_r($msg, true);
    }
    fwrite(
      STDOUT, '[' . date('Y-m-d H:i:s') . '] ' . $msg . "\nfrom: " . self::logFrom($from) . "\n\n"
    );
  }

  public static function toString() {
    if (!in_array($_SERVER['REMOTE_ADDR'], self::$restrict)) {
      return false;
    }
    echo '<pre>';
    var_dump(debug_backtrace());
    die('toString is not allowed');
  }

}
