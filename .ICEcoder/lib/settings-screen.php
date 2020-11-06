<?php
include "headers.php";
include "settings.php";
$t = $text['settings-screen'];
?>
<!DOCTYPE html>

<html>
<head>
<title>ICEcoder <?php echo $ICEcoder["versionNo"];?> settings screen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" type="text/css" href="../assets/css/settings-screen.css?microtime=<?php echo microtime(true);?>">
<link rel="stylesheet" href="../assets/css/codemirror.css?microtime=<?php echo microtime(true);?>">
<script src="../assets/js/codemirror-compressed.js?microtime=<?php echo microtime(true);?>"></script>

<style type="text/css">
.CodeMirror {position: absolute; width: 309px; height: 180px; font-size: <?php echo $ICEcoder["fontSize"];?>; transition: font-size 0.25s ease}
.CodeMirror-scroll {overflow: hidden}
/* Make sure this next one remains the 3rd item, updated with JS */
.cm-tab {border-left-width: <?php echo $ICEcoder["visibleTabs"] ? "1px" : "0";?>; margin-left: <?php echo $ICEcoder["visibleTabs"] ? "-1px" : "0";?>; border-left-style: solid; border-left-color: rgba(255,255,255,0.2)}
</style>

<link rel="stylesheet" href="../assets/css/theme/icecoder.css?microtime=<?php echo microtime(true);?>">
<?php
$themeArray = [];
$handle = opendir('../assets/css/theme/');
while (false !== ($file = readdir($handle))) {
	if ($file !== "." && $file !== ".." && $file !== "icecoder.css") {
		array_push($themeArray,basename($file,".css"));
	}
}
sort($themeArray);
for ($i = 0;$i < count($themeArray); $i++) {
	echo '<link rel="stylesheet" href="../assets/css/theme/' . $themeArray[$i] . '.css?microtime=' . microtime(true) . '">' . PHP_EOL;
}

// Do we have a tab to switch to?
$tabSwitchExtra = "";
if (true === isset($_GET['tab'])) {
    $tabSwitchExtra = "switchTab('" . $_GET['tab'] . "');";
}
?>
<link rel="stylesheet" href="../assets/css/simplescrollbars.css?microtime=<?php echo microtime(true);?>">
</head>

<body class="settings" onkeyup="parent.ICEcoder.handleModalKeyUp(event, 'settings')" onload="<?php echo $tabSwitchExtra;?>this.focus();">

<div class="infoPane">
	<a href="https://icecoder.net" target="_blank"><img src="../assets/images/icecoder.png" alt="ICEcoder" class="logo"></a>

	<h1 style="margin: 10px 0"><?php echo $t['settings'];?></h1>

	<p>
	<?php echo $t['version'];?>:<br>
	v <?php echo $ICEcoder["versionNo"];?>
	<br><br>

	<?php echo $t['website'];?>:<br>
	<a href="https://icecoder.net" target="_blank">https://icecoder.net</a>
	<br><br>

	<?php echo $t['git'];?>:<br>
	<a href="https://github.com/icecoder/ICEcoder" target="_blank">https://github.com/icecoder/ICEcoder</a>
	<br><br>

	<?php echo $t['codemirror version'];?>:<br>
	<script>
	document.write(CodeMirror.version);
	</script>
	<br><br>

	<?php echo $t['file manager root'];?>:<br>
	<?php echo "" === $ICEcoder['root'] ? "/" : $ICEcoder['root'];?>
	<br><br>

	<div style="font-size: 10px; line-height: 12px">
		<?php echo $t['Get in contact...'];?><br>
		<a href="https://www.twitter.com/icecoder" style="font-size: 10px" target="_blank">Twitter</a><br>
		<a href="https://facebook.com/ICEcoder.net" style="font-size: 10px" target="_blank">Facebook</a><br>
		<a href="https://groups.google.com/forum/#!forum/icecoder" style="font-size: 10px" target="_blank">Google Groups</a><br>
		<a href="https://github.com/icecoder/ICEcoder" style="font-size: 10px" target="_blank">GitHub</a><br>
		<a href="mailto:info@icecoder.net" style="font-size: 10px">Email</a><br><br>
		<?php echo $t['You may use...'];?>
	</div>
	</p>
</div>

<form name="settings" action="settings.php" method="POST">

<div class="tabContainer">
	<div id="generalTab" class="tab tabActive" onclick="switchTab('general')">General</div>
	<div id="styleTab" class="tab" onclick="switchTab('style')">Style</div>
	<div id="accountsTab" class="tab" onclick="switchTab('accounts')">Accounts</div>
	<div id="securityTab" class="tab" onclick="switchTab('security')">Security</div>
</div>

<div id="generalSection" class="section" style="display: block">

	<div style="display: inline-block; margin-right: 40px">

		<h2>language</h2><br>
		<select onchange="showButton()" name="languageUser">
		<?php
		$langFiles = [
		    "chinese-simplified.php",
            "chinese-traditional.php",
            "dutch.php",
            "english.php",
            "french.php",
            "german.php",
            "italian.php",
            "norwegian.php",
            "persian.php",
            "portuguese-brazilian.php",
            "spanish.php"
        ];
		$langText = [
		    "中国（简体）",
            "中國（繁體）",
            "Nederlands",
            "English",
            "Français",
            "Deutsch",
            "Italiano",
            "Norsk",
            "فارسی",
            "Portugues(br)",
            "Espa&ntilde;ol"
        ];
		for ($i = 0; $i < count($langFiles); $i++) {
			echo '<option value="' . $langFiles[$i] . '"' . ($ICEcoder["languageUser"] === $langFiles[$i] ? ' selected' : '') . '>' . $langText[$i] . '</option>' . PHP_EOL;
		}
		?>
		</select> <span class="info" style="display: inline-block; padding-top: 2px" title="Reload required after changing">[?]</span>
		<br><br>

		<h2><?php echo $t['functionality'];?></h2><br>
		<input type="checkbox" onclick="showButton()" name="checkUpdates" value="true"<?php if (true === $ICEcoder["checkUpdates"]) {echo ' checked';};?>> <?php echo $t['check for updates...'];?><br>
		<input type="checkbox" onclick="showButton()" name="openLastFiles" value="true"<?php if (true === $ICEcoder["openLastFiles"]) {echo ' checked';};?>> <?php echo $t['auto open last...'];?><br>
		<input type="checkbox" onclick="showButton()" name="updateDiffOnSave" value="true"<?php if (true === $ICEcoder["updateDiffOnSave"]) {echo ' checked';};?>> update diff pane on save
		<br><br>

		<h2><?php echo $t['assisting'];?></h2><br>
		<input type="checkbox" onclick="showButton()" name="codeAssist" value="true"<?php if($ICEcoder["codeAssist"]) {echo ' checked';};?>> <?php echo $t['code assist'];?><br>
		<br>
		<?php echo $t['tag wrapper command'];?><br>
		<select onchange="showButton()" name="tagWrapperCommand">
			<option value="ctrl+alt"<?php if ($ICEcoder["tagWrapperCommand"]=='ctrl+alt') {echo " selected";};?>>ctrl/cmd + alt</option>
			<option value="alt-left"<?php if ($ICEcoder["tagWrapperCommand"]=='alt-left') {echo " selected";};?>>alt left</option>
		</select>
		<br><br>

		<?php echo $t['auto-complete on'];?><br>
		<select onchange="showButton()" name="autoComplete">
			<option value="ctrl+space"<?php if ($ICEcoder["autoComplete"]=='ctrl+space') {echo " selected";};?>>ctrl/cmd + space</option>
			<option value="keypress"<?php if ($ICEcoder["autoComplete"]=='keypress') {echo " selected";};?>>keypress</option>
		</select>
		<br><br>

	</div>

	<div style="display: inline-block">

		<h2>find &amp; replace</h2><br>
		<?php echo $t['when finding in...'];?>:<br>
		<input type="text" onkeydown="showButton()" name="findFilesExclude" style="width: 300px" value="<?php echo implode(", ",$ICEcoder["findFilesExclude"]); ?>">
		<br><br>

		<h2><?php echo $t['bug reporting'];?></h2><br>
		<?php echo $t['check in files'];?> <span class="info" title="<?php echo $t['Slash prefixed comma...'];?>">[?]</span><br>
		<input type="text" name="bugFilePaths" style="width: 300px" onkeydown="showButton()" value="<?php echo implode(", ", $ICEcoder["bugFilePaths"]);?>"><br>
		<span style="display: inline-block; padding: 6px 5px 0 0">...<?php echo $t['every'];?></span>
		<input type="text" name="bugFileCheckTimer" style="width: 50px; margin-top: 3px" onkeydown="showButton()" value="<?php echo $ICEcoder["bugFileCheckTimer"];?>">
		<span style="display: inline-block; padding: 6px 5px 0 5px"><?php echo $t['secs getting last'];?></span>
		<input type="text" name="bugFileMaxLines" style="width: 50px; margin-top: 3px" onkeydown="showButton()" value="<?php echo $ICEcoder["bugFileMaxLines"];?>">
		<span style="display: inline-block; padding: 6px 5px 0 5px"><?php echo $t['lines'];?></span>
		<br><br>

		<h2><?php echo $t['file manager'];?></h2><br>
		<?php echo $t['root'];?> <span class="info" title="<?php echo $t['Slash prefixed'];?>">[?]</span><br>
		<input type="text" name="root" style="width: 300px" onkeydown="document.settings.changedFileSettings.value = 'true'; showButton()" value="<?php echo $ICEcoder["root"];?>">
		<br><br>

		<h2><?php echo $t['backups'];?></h2><br>
		<input type="checkbox" onclick="showButton(); changeBackupsDaysStatus();" name="backupsKept" value="true"<?php if ($ICEcoder["backupsKept"]) {echo ' checked';};?>> <?php echo $t['keep version control...'];?> <input type="text" name="backupsDays" id="backupsDays" style="width: 50px; margin: 3px 5px 0 5px" onkeydown="document.settings.changedFileSettings.value = 'true'; showButton()" value="<?php echo $ICEcoder["backupsDays"];?>" <?php
			if (false === $ICEcoder["backupsKept"]){
			echo ' disabled=""';
			}?>> <?php echo $t['days'];?><br>
		<div style="padding: 5px 5px 5px 5px; color: #888">
		<?php
		// Display number of days backups available
		$backupDirBase = str_replace("\\", "/", dirname(__FILE__)) . "/../data/backups/";
		$backupDirHost = true === isset($ftpSite) ? parse_url($ftpSite, PHP_URL_HOST) : "localhost";
		$backupDirsList = scandir($backupDirBase . $backupDirHost);
		// Remove . and .. from array
		for ($i = 0; $i < count($backupDirsList); $i++) {
			if ($backupDirsList[$i] === "." || $backupDirsList[$i] === "..") {
				array_splice($backupDirsList, $i, 1);
				$i--;
			}
		}
		// Display text re the number of days backups have taken place
		$backupNumDays = "" != $backupDirsList[0] && count($backupDirsList) > 0 ? count($backupDirsList) : 0;
		echo $backupNumDays . " " . (1 !== $backupNumDays ? $t['days'] : $t['day']) . " " . $t['of backups stored...'];
		?>
		</div><br>

		<input type="checkbox" onclick="showButton();" name="deleteToTmp" value="true"<?php if ($ICEcoder["deleteToTmp"]) {echo ' checked';};?>> <?php echo $t['deleting actually moves...'];?> <span class="info" title="<?php echo $t['local/server items...'];?>" style="position: absolute; margin-top: 6px"> &nbsp; [?]</span>
		<br><br>

	</div>
</div>

<div id="styleSection" class="section" style="display: none">

	<div style="display: inline-block; width: 300px; margin-right: 35px">
		<div style="height: 220px">
			<h2>preview</h2><br>
			<textarea id="code" name="code">
function findSequence(goal) {
	function find(start,history) {
		if (start==goal)
				return history;
		else if (start>goal)
			return null;
		else
			return find(start+5,"("+history+"+5)") ||
			find(start*3,"("+history+"*3)");
	}
	return find(1,"1");
}</textarea>
		</div>
		<br><br>

		<h2><?php echo $t['layout'];?></h2><br>
		<input type="checkbox" onclick="showButton()" name="lockedNav" value="true"<?php if (true === $ICEcoder["lockedNav"]) {echo ' checked';};?>> <?php echo $t['locked nav'];?><br><br>
		<?php echo $t['plugin panel aligned'];?><br>
		<select onchange="showButton()" name="pluginPanelAligned">
			<option value="left"<?php if ("left" === $ICEcoder["pluginPanelAligned"]) {echo " selected";};?>>left</option>
			<option value="right"<?php if ("right" === $ICEcoder["pluginPanelAligned"]) {echo " selected";};?>>right</option>
		</select>
		<br><br>

	</div><div style="display: inline-block">
		<h2><?php echo $t['style'];?></h2><br>
		<?php echo $t['theme'];?><br>
		<select onchange="selectTheme(); showButton()" id="theme" name="theme" style="width: 145px">
		    <option<?php if ("default" === $ICEcoder["theme"]) {echo ' selected';}; ?>>default</option>
		<?php
		for ($i = 0;$i < count($themeArray); $i++) {
			$optionSelected = $ICEcoder["theme"] === $themeArray[$i] ? ' selected' : '';
			echo '<option' . $optionSelected . '>' . $themeArray[$i] . '</option>' . PHP_EOL;
		}
		?>
		</select>
		<br><br>

		<div style="display: inline-block; width: 145px">
			<?php echo $t['font size'];?><br>
			<input type="text" name="fontSize" id="fontSize" style="width: 44px" onkeydown="showButton()" onkeyup="changeFontSize()" value="<?php echo $ICEcoder["fontSize"];?>">
		</div><div style="display: inline-block">
			<?php echo $t['indent size'];?><br>
			<input type="text" name="indentSize" id="indentSize" style="width: 44px" onkeydown="showButton()" onkeyup="changeIndentSize()" value="<?php echo $ICEcoder["indentSize"];?>">
		</div>
		<br><br>

		<div style="display: inline-block; width: 145px">
            <input type="checkbox" onclick="showButton()" name="matchBrackets" value="true"<?php if (true === $ICEcoder["matchBrackets"]) {echo ' checked';};?>> <?php echo $t['match brackets'];?><br>
		</div><div style="display: inline-block">
            <input type="checkbox" onclick="showButton()" name="showTrailingSpace" value="true"<?php if (true === $ICEcoder["showTrailingSpace"]) {echo ' checked';};?>> <?php echo $t['show trailing space'];?><br>
		</div>
        <br>

		<div style="display: inline-block; width: 145px">
            <input type="checkbox" onclick="showButton()" name="lineWrapping" value="true"<?php if (true === $ICEcoder["lineWrapping"]) {echo ' checked';};?>> <?php echo $t['line wrapping'];?><br>
		</div><div style="display: inline-block">
            <input type="checkbox" onclick="changeLineNumbersToggle(); showButton()" name="lineNumbers" id="lineNumbers" value="true"<?php if (true === $ICEcoder["lineNumbers"]) {echo ' checked';};?>> <?php echo $t['line numbers'];?><br>
		</div>
		<br>

        <input type="checkbox" onclick="showButton();showHideTabs()" name="visibleTabs" value="true"<?php if (true === $ICEcoder["visibleTabs"]) {echo ' checked';};?>> <?php echo $t['visible tabs'];?>
        <br><br>

        <div style="display: inline-block; width: 145px">
            <?php echo $t['scrollbars'];?><br>
            <select onchange="changeScrollbarStyle(); showButton()" name="scrollbarStyle" id="scrollbarStyle">
                <option value="overlay"<?php if ($ICEcoder["scrollbarStyle"] === "overlay") {echo " selected";};?>>overlay</option>
                <option value="simple"<?php if ($ICEcoder["scrollbarStyle"] === "simple") {echo " selected";};?>>simple</option>
                <option value="native"<?php if ($ICEcoder["scrollbarStyle"] === "native") {echo " selected";};?>>native</option>
            </select>
        </div>
        <br><br>

		<h2><?php echo $t['functionality'];?></h2><br>

		<div style="display: inline-block; width: 145px">
			<?php echo $t['indent type'];?><br>
			<select onchange="showButton()" name="indentType">
				<option value="spaces"<?php if ("spaces" === $ICEcoder["indentType"]) {echo " selected";};?>>spaces</option>
				<option value="tabs"<?php if ("tabs" === $ICEcoder["indentType"]) {echo " selected";};?>>tabs</option>
			</select>
			<br><br>

		</div><div style="display: inline-block">
            <input type="checkbox" onclick="showButton()" name="indentAuto" value="true"<?php if (true === $ICEcoder["indentAuto"]) {echo ' checked';};?>> <?php echo $t['auto indent'];?><br>
            <input type="checkbox" onclick="showButton()" name="autoCloseTags" value="true"<?php if (true === $ICEcoder["autoCloseTags"]) {echo ' checked';};?>> <?php echo $t['auto close tags'];?><br>
            <input type="checkbox" onclick="showButton()" name="autoCloseBrackets" value="true"<?php if (true === $ICEcoder["autoCloseBrackets"]) {echo ' checked';};?>> <?php echo $t['auto close brackets'];?><br>
		</div>
		<br><br>

	</div>

</div>

<div id="accountsSection" class="section" style="display: none">

	<h2>password</h2><br>
	<?php echo $t['new password'];?> <span class="info" title="<?php echo $t['8 chars min'];?>">[?]</span><br>
	<input type="password" name="password" style="width: 320px" onkeydown="showButton()">
	<br><br>

	<?php echo $t['confirm password'];?><br>
	<input type="password" name="passwordConfirm" style="width: 320px" onkeydown="showButton()">
	<br><br>

	<h2><?php echo $t['multi-user'];?> <span class="info" title="<?php echo $t['Make sure you...'];?>">[?]</span></h2><br>
	<input type="checkbox" name="multiUser" value="true" onclick="showButton(); changeEnableRegistrationStatus();"<?php if (true === $ICEcoder["multiUser"]) {echo ' checked';} ?>>Multi-User
	<?php
		echo '<input type="checkbox" name="enableRegistration" value="true"';
		if (true === $ICEcoder["enableRegistration"]) {echo ' checked';}
		if (false === $ICEcoder["multiUser"]){
		echo ' disabled=""';
		}
		echo ' onclick="showButton()" id="enableRegistration"> ' . $t['Registration'] . ' </input>';
	?>

    <br><br>

    <input type="checkbox" onclick="showButton()" name="tutorialOnLogin" value="true"<?php if (true === $ICEcoder["tutorialOnLogin"]) {echo ' checked';};?>> Tutorial on Login<br><br>

    <input type="checkbox" onclick="showButton()" name="tipsOnLogin" value="true"<?php if (true === $ICEcoder["tipsOnLogin"]) {echo ' checked';};?>> Tips on Login (Coming soon)<br><br>
</div>

<div id="securitySection" class="section" style="display: none">
	<h2><?php echo $t['security'];?></h2><br>
	<?php echo $t['banned files/folders'];?> <span class="info" title="<?php echo $t['Comma delimited'];?>">[?]</span><br>
	<input type="text" onkeydown="document.settings.changedFileSettings.value = 'true'; showButton()" name="bannedFiles" style="width: 660px" value="<?php echo implode(", ",$ICEcoder["bannedFiles"]); ?>">
	<br><br>

	<?php echo $t['banned paths'];?> <span class="info" title="<?php echo $t['Slash prefixed comma...'];?>">[?]</span><br>
	<input type="text" onkeydown="document.settings.changedFileSettings.value = 'true'; showButton()" name="bannedPaths" style="width: 660px" value="<?php echo implode(", ",$ICEcoder["bannedPaths"]); ?>">
	<br><br>

	<input type="hidden" name="changedFileSettings" value="false">
	<?php echo $t['ip addresses'];?> <span class="info" title="<?php echo $t['Comma delimited'];?>">[?]</span><br>
	<input type="text" onkeydown="showButton()" name="allowedIPs" style="width: 660px" value="<?php echo implode(", ",$ICEcoder["allowedIPs"]); ?>">
	<br><br>

	<?php echo $t['auto-logout after'];?> <span class="info" title="<?php echo $t['Set 0 to...'];?>">[?]</span><br>
	<input type="text" onkeydown="showButton()" name="autoLogoutMins" style="width: 100px" value="<?php echo $ICEcoder["autoLogoutMins"]; ?>"> <span style="display: inline-block; padding: 2px 5px"><?php echo $t['mins of inactivity...'];?></span>
	<br><br>
</div>

<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
	lineNumbers: parent.ICEcoder.lineNumbers,
	readOnly: "nocursor",
	indentUnit: parent.ICEcoder.indentSize,
	tabSize: parent.ICEcoder.indentSize,
	mode: "javascript",
	theme: "<?php echo "default" === $ICEcoder["theme"] ? 'icecoder' : $ICEcoder["theme"];?>",
    scrollbarStyle: parent.ICEcoder.scrollbarStyle
});

function selectTheme() {
    const input = document.getElementById("theme");
	let theme = input.options[input.selectedIndex].innerHTML;
	if ("default" === theme) {theme = "icecoder"}
	editor.setOption("theme", theme);
}

function changeIndentSize() {
	const indentSize = document.getElementById("indentSize").value;
	editor.setOption("indentUnit", indentSize);
	editor.setOption("tabSize", indentSize);
	editor.refresh();
}


function changeLineNumbersToggle() {
	const lineNumbers = document.getElementById("lineNumbers").checked;
	editor.setOption("lineNumbers", lineNumbers);
	editor.refresh();
}

function changeScrollbarStyle() {
    const scrollbarStyle = document.getElementById("scrollbarStyle").value;
    editor.setOption("scrollbarStyle", scrollbarStyle);
    editor.refresh();
}

function changeFontSize() {
	let cMCSS = document.styleSheets[2];
	let strCSS = cMCSS.rules ? 'rules' : 'cssRules';
	cMCSS[strCSS][0].style['fontSize'] = document.getElementById("fontSize").value;
	editor.refresh();
}

function changeEnableRegistrationStatus(){
	document.getElementById('enableRegistration').disabled=!document.getElementById('enableRegistration').disabled;
}

function changeBackupsDaysStatus(){
	document.getElementById('backupsDays').disabled=!document.getElementById('backupsDays').disabled;
}

function showButton() {
	document.getElementById('updateButton').style.opacity = 1;
}

function showHideTabs() {
	let cMCSS = document.styleSheets[2];
    let strCSS = cMCSS.rules ? 'rules' : 'cssRules';
	cMCSS[strCSS][2].style['border-left-width'] = document.settings.visibleTabs.checked ? '1px' : '0';
	cMCSS[strCSS][2].style['margin-left'] = document.settings.visibleTabs.checked ? '-1px' : '0';
}

function validatePasswords() {
	if ("" !== document.settings.password.value && 8 > document.settings.password.value.length) {
        parent.ICEcoder.message('Please use at least 8 chars in the password');
	} else {
		if (document.settings.password.value !== document.settings.passwordConfirm.value) {
            parent.ICEcoder.message('Sorry, your passwords don\'t match')
		} else {
			document.settings.submit();
		}
	}
}

tabNames = ['general','style','accounts','security'];

function switchTab(tab) {
	for (var i = 0; i < tabNames.length; i++) {
		document.getElementById(tabNames[i] + 'Tab').className = tabNames[i] === tab ? "tab tabActive" : "tab";
		document.getElementById(tabNames[i] + 'Section').style.display = tabNames[i] === tab ? "block" : "none";
	}
	editor.refresh();
}

function submitSettings() {
    <?php echo true === $ICEcoder['demoMode'] ? "parent.ICEcoder.message('Sorry, can\'t commit settings in demo mode')" : "validatePasswords()"; ?>;
}
</script>

<div class="update" id="updateButton" onClick="submitSettings()">update</div>
<input type="hidden" name="csrf" value="<?php echo $_SESSION["csrf"]; ?>">
</form>

</body>

</html>