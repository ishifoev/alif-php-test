<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование кабинетов</title>
</head>
<body>
    <h1>Доступные кабинеты</h1>
    <table>
        <thead>
            <tr>
                <th>Номер кабинета</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('includes/database.php');

            // Запрос к базе данных для получения кабинетов
            $offices = getAvailableOffices();

            foreach ($offices as $office) {
                echo "<tr>";
                echo "<td>" . $office['name'] . "</td>";
                echo "<td>" . ($office['is_available'] ? 'Доступен' : 'Занят') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Форма для создания офиса -->
    <div id="createOfficeForm" style="display: none;">
        <h2>Создание офиса</h2>
        <form action="create_office.php" method="POST">
            <label for="office_name">Название офиса:</label>
            <input type="text" name="office_name" id="office_name" required>
            <button type="submit">Добавить офис</button>
        </form>
    </div>

    <!-- Форма для бронирования кабинета -->
    <div id="reserveOfficeForm" style="display:none;">
        <h2>Бронирование кабинета</h2>
        <form action="reserve.php" method="POST">
            <label for="office_id">Выберите кабинет:</label>
            <select name="office_id" id="office_id" required>
                <?php
                if (empty($offices)) {
                    echo "<option value=''>Нет доступных кабинетов</option>";
                } else {
                    foreach ($offices as $office) {
                        echo "<option value='" . $office['id'] . "'>" . $office['name'] . "</option>";
                    }
                }
                ?>
            </select><br>
            <label for="start_time">Дата и время начала бронирования:</label>
            <input type="datetime-local" name="start_time" id="start_time" required><br>
            <label for="end_time">Дата и время окончания бронирования:</label>
            <input type="datetime-local" name="end_time" id="end_time" required><br>
            <label for="reserved_by_name" >Ваше имя:</label>
            <input type="text" name="reserved_by_name" id="reserved_by_name" required><br>
            <label for="reserved_by_email">Ваш email:</label>
            <input type="email" name="reserved_by_email" id="reserved_by_email" required><br>
            <label for="reserved_by_phone">Ваш номер телефона:</label>
            <input type="tel" name="reserved_by_phone" id="reserved_by_phone" required><br>
            <input type="submit" value="Забронировать">
        </form>
    </div>

    <div id="testOffce">
        <button id="createOfficeBtn">Создать кабинет</button>
        <button id="reserveOfficeBtn">Бронирование кабинета</button>
    </div>

    <script>
        const createOfficeBtn = document.getElementById('createOfficeBtn');
        const reserveOfficeBtn = document.getElementById('reserveOfficeBtn');
        const createOfficeForm = document.getElementById('createOfficeForm');
        const reserveOfficeForm = document.getElementById('reserveOfficeForm');

        // Скрыть форму для создания офиса по умолчанию
        createOfficeForm.style.display = 'none';

        createOfficeBtn.addEventListener('click', () => {
            testOffce.style.display = "none";
            createOfficeForm.style.display = 'block';
            reserveOfficeForm.style.display = 'none';
        });

        reserveOfficeBtn.addEventListener('click', () => {
            //testOffce.style.display = "none";
            reserveOfficeBtn.style.display = "none";
            createOfficeForm.style.display = 'none';
            reserveOfficeForm.style.display = 'block';
        });
    </script>
</body>
</html>
