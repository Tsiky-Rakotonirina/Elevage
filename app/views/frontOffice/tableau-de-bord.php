<link rel="stylesheet" href="<?=$url ?>/public/assets/css/tableau-de-bord.css">
<script src="<?=$url ?>/public/assets/js/calendar.js"></script>
<div class="reinitialiser">
    <form action="reinitialiser" method="post">
        <input name="dateReinitialiser" value="2025-02-03" readonly>
        <button type="submit">Reinitiliser</button>
    </form>
</div>
<div class="row">
    <br><br><br>
    <form id="date-form" action="fermeFiltre" method="GET">
        <div class="contain">
            <div class="calendar">
                <div class="controls">
                <select id="month-select"></select>
                <select id="year-select"></select>
                </div>
                <div class="days" id="days">
                </div>
            </div>
            <div class="button-valid">
                <input type="hidden" name="date" id="selected-date">
                <button type="submit" id="submit-button">Voir situation</button>
            </div>
        </div>
        
    </form>
</div>
<h1>
    <?php
        if (isset($_POST['date'])) {
            $selectedDate = $_POST['selected_date'];
            $type=$_POST['type'];

        // Valider la date
        if (DateTime::createFromFormat('Y-m-d', $selectedDate)) {
            echo "Date sélectionnée : " . htmlspecialchars($selectedDate);
            echo "\n    Type :".$type;
        } else {
            echo "Date invalide.";
        }
    } else {
        
    }
?>
  


</h1>