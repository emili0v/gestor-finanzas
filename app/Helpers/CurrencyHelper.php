<?php

if (!function_exists('formatCLP')) {
    function formatCLP($amount)
    {
        return '$' . number_format($amount, 0, ',', '.') . ' CLP';
    }
}

if (!function_exists('formatCLPShort')) {
    function formatCLPShort($amount)
    {
        return '$' . number_format($amount, 0, ',', '.');
    }
} 
