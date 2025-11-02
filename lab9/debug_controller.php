<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\ArticleController;
use App\Models\User;

$user = User::where('email','demo@huit.edu.vn')->first();
if (!$user) {
    echo "NO DEMO USER\n";
    exit(1);
}
auth()->login($user);

try {
    $controller = new ArticleController();
    $res = $controller->create();
    if (is_string($res)) {
        echo $res;
    } elseif (method_exists($res, 'render')) {
        echo $res->render();
    } else {
        echo json_encode(['type'=>get_class($res), 'content'=>(string)$res]);
    }
} catch (Throwable $e) {
    echo get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString();
}
