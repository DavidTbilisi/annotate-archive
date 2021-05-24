<?= $this->extend('base_view') ?>
<?= $this->section('content') ?>
<div class="uk-container uk-section">
    <h1>Hello World!</h1>

    <input id="text" type="text" value="https://hogangnono.com" style="width:80%" /><br />
<div id="qrcode"></div>
<script type="text/javascript">

var qrcode = new QRCode("qrcode");

function makeCode () {    
  var elText = document.getElementById("text");
  
  if (!elText.value) {
    alert("Input a text");
    elText.focus();
    return;
  }
  
  qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
  on("blur", function () {
    makeCode();
  }).
  on("keydown", function (e) {
    if (e.keyCode == 13) {
      makeCode();
    }
  });

</script>

<style>
#qrcode {
  width:160px;
  height:160px;
  margin-top:15px;
}

</style>
</div>

<?= $this->endSection() ?>