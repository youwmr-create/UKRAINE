<?php
// Налаштування пошти
$to = "youwmr@gmail.com"; // Вкажіть вашу пошту, куди надсилати листи
$subject = "Нове повідомлення з форми зворотного зв'язку";

// Перевірка, чи форма була надіслана методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Очищення даних від зайвих пробілів та шкідливого коду
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $message = trim(htmlspecialchars($_POST['message']));

    // Валідація полів
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Будь ласка, коректно заповніть усі поля форми.";
        exit;
    }

    // Формування тексту листа
    $email_content = "Ім'я: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Повідомлення:\n$message\n";

    // Налаштування заголовків (Запобігає ламанню кодування)
    $headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Надсилання листа
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Дякуємо! Ваше повідомлення успішно надіслано.";
    } else {
        echo "Прикро, але виникла помилка під час відправки листа.";
    }
} else {
    echo "Доступ заборонено.";
}
?>