<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="web_l/css/chosen.css">
    <style type="text/css">

        body {
            font-family: Arial, Sans-Serif;
        }

        .has-error {
            border-color: red;
        }

        .has-success {
            border-color: aqua;
        }

        .input-field, .select-field {
            position: relative;
            left: 30%;
        }

        .hidden {
            display: none;
        }

        form {
            position: relative;
            top: 50px;
        }

        form input[data-name="name"],
        form input[data-name="email"] {
            width:160px;
            position: absolute;
            left: 105px;
        }

        form button {
            position: absolute;
            left: 105px;
        }

    </style>
</head>

<body>

<form>
    <div class="input-field">
        <p>ФИО* <input type="text" data-name="name" id="name" placeholder="ФИО*"></p>
        <div id="error-name"></div>
    </div>
    <div class="input-field">
        <p>E-mail* <input type="email" data-name="email" id="email" placeholder="E-mail*"></p>
        <div id="error-email"></div>
    </div>
    <div class="select-field">
        <p>
            <select class="chosen-select" data-name="region" name="hero[]" id="region">
                <option selected disabled value="">Выберетите адрес</option>
                <?php foreach ($territory as $ter): ?>
                    <option value="<?= $ter['ter_id']; ?>"><?= $ter['ter_name']; ?></option>
                <?php endforeach; ?>
            </select></p>
        <div id="error-region"></div>
    </div>
    <div class="select-field hidden">
        <p>
            <select class="chosen-select" data-name="city" id="city">
                <option selected disabled value="">Выберетите адрес</option>
            </select></p>
        <div id="error-city"></div>
    </div>
    <div class="select-field hidden">
        <p>
            <select class="chosen-select" data-name="city-region" id="city-region">
                <option selected disabled value="">Выберетите адрес</option>
            </select></p>
        <div id="error-city-region"></div>
    </div>
    <div class="input-field">
        <p><button type="button" id="send">Отправить</button></p>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Пользователь с таким email уже существует</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hу ок...</button>
            </div>
        </div>
    </div>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='node_modules/chosen-js/chosen.jquery.min.js'></script>
<script type="text/javascript" src='web_l/js/main.js'></script>

</body>

</html>
