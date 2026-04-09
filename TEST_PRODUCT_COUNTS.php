<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\PostProduct;

echo "\n=== PRODUCT COUNT TEST ===\n";
echo "Total Products: " . PostProduct::count() . "\n";
echo "Available Products: " . PostProduct::where('status', 'available')->count() . "\n";
echo "Sold Products: " . PostProduct::where('status', 'sold')->count() . "\n";
echo "\nNote: These counts should update automatically when:\n";
echo "1. New products are posted (added to available count)\n";
echo "2. Products are purchased (moved from available to sold)\n";
echo "========================\n\n";
