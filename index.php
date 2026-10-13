<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$tickets = [
    ['subject' => 'Не працює вхід в систему', 'priority' => 'urgent', 'status' => 'open'],
    ['subject' => 'Запит на оновлення пароля', 'priority' => 'normal', 'status' => 'closed'],
    ['subject' => 'Помилка при оплаті замовлення', 'priority' => 'urgent', 'status' => 'open'],
    ['subject' => 'Питання щодо нових тарифів', 'priority' => 'low', 'status' => 'closed'],
    ['subject' => 'Збій у роботі API сервера', 'priority' => 'urgent', 'status' => 'closed'],
];

function formatTicket(array $ticket): string {
    $statusText = $ticket['status'] === 'open' ? 'Відкритий' : 'Закритий';
    return "<strong>{$ticket['subject']}</strong> — Статус: {$statusText}";
}

$openCount = 0;
$closedCount = 0;

foreach ($tickets as $ticket) {
    if ($ticket['status'] === 'open') {
        $openCount++;
    } elseif ($ticket['status'] === 'closed') {
        $closedCount++;
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Практична робота №1 - Варіант 19</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f9; }
        .ticket-card { background: white; border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; border-radius: 8px; }
        .priority-urgent { color: white; background-color: #e74c3c; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; font-weight: bold;}
        .priority-normal { color: #333; background-color: #ecf0f1; padding: 3px 8px; border-radius: 4px; font-size: 0.9em; }
        .summary { background: #fff; padding: 15px; border-radius: 8px; margin-top: 20px; border: 2px solid #3498db; }
    </style>
</head>
<body>

<h1>Система тікетів служби підтримки</h1>

<?php
foreach ($tickets as $ticket):
    $isUrgent = ($ticket['priority'] === 'urgent');
    $priorityLabel = $isUrgent ? 'Терміновий' : 'Звичайний';
    $priorityClass = $isUrgent ? 'priority-urgent' : 'priority-normal';
    ?>
    <div class="ticket-card">
        <p><?= formatTicket($ticket) ?></p>
        <p>Пріоритет: <span class="<?= $priorityClass ?>"><?= $priorityLabel ?></span></p>
    </div>
<?php endforeach; ?>

<div class="summary">
    <h2>Агрегатні показники:</h2>
    <p>Кількість відкритих тікетів: <strong><?= $openCount ?></strong></p>
    <p>Кількість закритих тікетів: <strong><?= $closedCount ?></strong></p>
</div>

</body>
</html>