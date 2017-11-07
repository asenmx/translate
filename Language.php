<?php

class Language
{
    const ENG = 'EngText.php';
    const ENG_ID = 1;
    const ENG_HOLDER = 'EN';

    const BG = 'BgText.php';
    const BG_ID = 2;
    const BG_HOLDER = 'BG';

    /**
     * Gets language id and returns text in the selected language.
     * @param $key
     * @return mixed
     */
    public static function languagePicker($key)
    {
        /*Checks if language exist and if it does picks it.*/
        if ($_POST['id'] == SELF::ENG_ID) {
            $languageLibrary = SELF::ENG;
        } elseif ($_POST['id'] == SELF::BG_ID) {
            $languageLibrary = SELF::BG;
        } else {

            return $key;
        }
        /*If text array key doesn't exist returns the key.*/
        if (!isset($languageLibrary)) {
            return $key;
        }

        $lib = require $languageLibrary;
        if (!isset($lib[$key])) {

            return $key;
        }

        return $lib[$key];
    }
}

if (!isset($_POST['id'])) {
    $_POST['id'] = Language::ENG_ID;
}
if (!isset($_POST['tabid'])) {
    $_POST['tabid'] = 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script>

        function pickLang(str) {
            var childSelected;
            $("div[class=tab]").children('button').each(function () {
                var myClasses = this.classList;
                var child = this.value;
                $.each(myClasses, function () {
                    if (this == 'active') {
                        childSelected = child;
                    }
                });
            });
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "tabid").val(childSelected);
            $('#language-picker').append($(input));
            $("#language-picker").submit();
        };

        function getContent(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;
            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <style>
        div.tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        div.tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        div.tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        div.tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        /* add this to the CSS */
        .tabcontent.active {
            display: block;
        }
    </style>
</head>
<body>

<div>
    <form id="language-picker" action="Language.php" method="post">
        <select name="id" onchange="pickLang(this.value)">
            <option value="<?php echo Language::ENG_ID; ?>" <?php if ($_POST['id'] == Language::ENG_ID) { ?> selected <?php } ?>><?php echo Language::ENG_HOLDER; ?> </option>
            <option value="<?php echo Language::BG_ID; ?>" <?php if ($_POST['id'] == Language::BG_ID) { ?> selected <?php } ?>><?php echo Language::BG_HOLDER; ?></option>
        </select>
    </form>
</div>
<div class="tab">
    <button class="tablinks <?php if ($_POST['tabid'] == '1') { ?> active <?php } ?>"
            value="1"
            onclick="getContent(event, 'Yaga');"><?php echo Language::languagePicker("YagaTitle"); ?></button>


    <button class="tablinks <?php if ($_POST['tabid'] == '2') { ?> active <?php } ?>"
            value="2"
            onclick="getContent(event, 'Father');"><?php echo Language::languagePicker("FatherTitle"); ?></button>
</div>


<div id="Yaga" class="tabcontent <?php if ($_POST['tabid'] == '1') { ?> active <?php } ?>" value="1">
    <h3><?php echo Language::languagePicker('YagaTitle'); ?></h3>
    <p><?php echo Language::languagePicker('YagaText'); ?></p>
</div>
<div id="Father" class="tabcontent <?php if ($_POST['tabid'] == 2) { ?> active <?php } ?>" value="2">
    <h3><?php echo Language::languagePicker('FatherTitle'); ?></h3>
    <p><?php echo Language::languagePicker('FatherText'); ?></p>
</div>
</body>
</html>



