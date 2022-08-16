<html>
  <body>
    <canvas id="canvas"></canvas>
    <script src="<?=base_url('node_modules/qrcode/build/qrcode.js')?>"></script>

    <img id="qr" src="" alt="">
  </body>
</html>

<script>
    QRCode.toDataURL('174496020|57|385401200329226|09/08/2022|136.00|136.00|0|24-00-BC-84|0|0|0|0', { errorCorrectionLevel: 'H' }, function (err, url) {
        document.getElementById("qr").src=url;
    });
</script>




