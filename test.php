<?php
if (function_exists('sybase_connect')) {
  echo 'exists_maybe';
} else {
  echo 'none';
}
