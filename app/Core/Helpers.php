<?php

declare(strict_types=1);

function dd(...$variables): void
{
    echo '<div style="background-color: #111; color: #eee; padding: 20px; font-family: monospace; border-radius: 8px; line-height: 1.5; margin: 20px;">';
    echo '<h2 style="color: #ff8c00; border-bottom: 1px solid #444; padding-bottom: 10px;">Dump and Die</h2>';

    foreach ($variables as $key => $value) {
        echo '<div style="margin-bottom: 15px;">';
        if ($key !== null) {
            echo '<strong style="color: #00ff00;">' . htmlspecialchars((string)$key) . ':</strong> ';
        }
        echo '<pre style="display: inline; background: #222; padding: 5px; border: 1px solid #333;">';
        var_dump($value);
        echo '</pre>';
        echo '</div>';
    }

    echo '</div>';
    die();
}
