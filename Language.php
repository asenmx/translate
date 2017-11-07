<?php

class Language
{
    public static function languagePicker($langId)
    {
        if ($langId == 1) {
            require 'EngText.php';

            return $engText;
        } elseif ($langId == 2) {
            require 'BgText.php';

            return $bgText;
        }
    }
}

var_dump($_POST);

if (!isset($_POST['id'])) {
    $_POST['id'] = 1;
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
            var childSelected = 1;
            $("div[class=tab]").children('button').each(function () {
                var myClasses = this.classList;
                var child = 1;
                child = this.value;
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
            <option value="1" <?php if ($_POST['id'] == 1) { ?> selected <?php } ?>>EN</option>
            <option value="2" <?php if ($_POST['id'] == 2) { ?> selected <?php } ?>>BG</option>
        </select>
    </form>
</div>
<div class="tab">
    <button class="tablinks <?php if ($_POST['tabid'] == '1') { ?> active <?php } ?>""
            value="1"
            onclick="getContent(event, 'Yaga');"><?php echo Language::languagePicker($_POST['id'])['YagaTitle']; ?></button>
    <button class="tablinks <?php if ($_POST['tabid'] == '2') { ?> active <?php } ?>""
            value="2"
            onclick="getContent(event, 'Father');"><?php echo Language::languagePicker($_POST['id'])['FatherTitle']; ?></button>
</div>


<div id="Yaga" class="tabcontent <?php if ($_POST['tabid'] == '1') { ?> active <?php } ?>" value="1">
    <h3><?php echo Language::languagePicker($_POST['id'])['YagaTitle']; ?></h3>
    <p><?php echo Language::languagePicker($_POST['id'])['YagaText']; ?></p>
</div>
<div id="Father" class="tabcontent <?php if ($_POST['tabid'] == 2) { ?> active <?php } ?>" value="2">
<h3><?php echo Language::languagePicker($_POST['id'])['FatherTitle']; ?></h3>
<p><?php echo Language::languagePicker($_POST['id'])['FatherText']; ?></p>
</div>
</body>
</html>



