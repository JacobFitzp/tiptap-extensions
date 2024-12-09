<?php

namespace App\Models\Enums;

enum ExtensionType: string
{
    case EXTENSION = 'extension';
    case PACKAGE = 'package';
    case PROJECT = 'project';
}
