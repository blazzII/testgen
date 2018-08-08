<?php
session_start();

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
      case 'example':
          break;

      default:
          include 'views/main-menu.php';
  }