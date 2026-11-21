<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Деталі книги</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            display: flex;
            gap: 20px;
        }

        .card img {
            max-width: 150px;
            height: auto;
            object-fit: cover;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <a class="back-link" href="index.php">← Повернутися до списку</a>

    <?php if ($book): ?>
        <div class="card">
            <div>
                <img src="images/<?php echo htmlspecialchars($book->getCoverPhoto()); ?>"
                    alt="<?php echo htmlspecialchars($book->getTitle()); ?>">
            </div>
            <div>
                <h2><?php echo htmlspecialchars($book->getTitle()); ?></h2>
                <p><b>Автор:</b> <?php echo htmlspecialchars($book->getAuthor()->getFullName()); ?>
                    (<?php echo htmlspecialchars($book->getAuthor()->getCountry()); ?>)</p>
                <p><b>Рік видання:</b> <?php echo $book->getPublishYear(); ?></p>
                <p><b>Кількість сторінок:</b> <?php echo $book->getPages(); ?></p>
                <p><b>Опис:</b> <?php echo htmlspecialchars($book->getDescription()); ?></p>
            </div>
        </div>
    <?php else: ?>
        <p>Книгу не знайдено.</p>
    <?php endif; ?>
</body>

</html>