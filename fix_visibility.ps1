$content = Get-Content "c:\xampp\htdocs\EnthusiastVerse-E-commerce\app\Filament\Resources\OrderResource.php"
$content = $content -replace "\$record->payment_status === 'pending' &&", "in_array(`$record->payment_status, ['pending', 'rejected']) &&"
Set-Content "c:\xampp\htdocs\EnthusiastVerse-E-commerce\app\Filament\Resources\OrderResource.php" -Value $content