<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificate</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #000;
    }

    .container {
      position: relative;
      width: 916px;
      height: 655px;
      margin: auto;
      overflow: hidden;
    }

    .img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('{{ $img }}');
      background-size: contain; 
      background-repeat: no-repeat;
      background-position: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: white;
      text-align: center;
      padding: 20px;
    }

    .logo {
      align-self: flex-start;
    margin-top: 46px;
    margin-left: 47px;
    width: 100px;
    height: auto;
    }

    .title {
      font-size: 49px;
      font-family: 'Times New Roman', Times, serif;
      font-weight: 800;
      color: #000;
      margin-bottom: 0px;
      /* margin-top: revert; */
    }

    .no {
      margin-top: -6px;
      font-size: 15px;
      color: #000;
      font-weight: 500;
    }

    .red-background {
      position: relative;
      background-color: rgb(175 6 6);
      margin-top: -10px;
      color: white;
      height: 39px;
      display: inline-block;
      width: 230px;
      text-align: center;
    }

    .red-background p {
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 20px;
      font-weight: 600;
      transform: translate(-50%, -50%);
      width: inherit;
      color: white;
    }

    .fullname {
      font-size: 40px;
      font-weight: 700;
      font-family: system-ui;
      margin-top: 10px;
      color: #000;
    }
    
    .underline {
      width: 459px;
      height: 3px;
      background-color: rgb(175 6 6);
      margin: auto;
    }

    .course {
      max-width: 310px; 
      margin: 0 auto; 
    }

    .course p {
      margin-top: 0px;
      font-size: 18px;
      font-weight: 500;
      color: #000;
    }

    .jurusan {
      margin-top: 6px;
      font-size: 20px;
      font-weight: 500;
      color: #000;
    }

    .title-section {
      font-size: 26px;
      margin-top: -8px;
      font-weight: 700;
      color: #000;
      font-family: system-ui;
    }

    .ketua-jurusan {
      position: relative;
      font-size: 13px;
      font-weight: 700;
    }

    .unerline-ttd {
      width: 100%; 
      height: 3px; 
      background-color: rgb(175 6 6);
      margin-top: 65px;
    }

    .ketua-jurusan p {
      font-size: 15px;
      font-family: system-ui;
      color: #000;
      margin-top: 12px;
    }

    .ketua-jurusan .nama-instruktor {
      font-size: 15px;
      font-weight: 400;
    }

    .ketua-jurusan .nip-instruktor {
      font-size: 13px;
      font-weight: 400; 
      margin-top: -20px;
    }

    .cover_image {
      position: absolute;
      top: 43%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80px;
      height: 58px;
    }

    .cover_image img {
      width: 100%; 
      height: 100%;
      object-fit: cover;
      border: 1px solid transparent;
    }

    .minutes {
      margin-top: -14px;
      font-size: 14px;
      font-weight: 500;
      color: #000;
    }

    .certificate-id {
      margin-top: -14px;
      font-size: 14px;
      color: #000;
      font-weight: 500;
    }

    .button {
      margin-left: 20px;
      margin-top: 10px;
      background-color: #950000;
      border: none;
    }

    .button:hover {
      background-color: #950000;
    }

  </style>
</head>
<body>
  <button class="button btn btn-primary" id="dl-png">Download Certificate</button>
  <div class="container" id="example-table">
    <div class="img">
      <img src="/store/1/default_images/logo-aaipi1.png" alt="AAIPI Logo" class="logo">
      <div class="text-center w-100">
        <h1 class="title">SERTIFIKAT</h1>
        <p class="no">No. 123/stf/XIX/2024</p>
        <div class="red-background">
          <p class="mb-0">Diberikan Kepada</p>
        </div>
        <h3 class="fullname">{{$fullname}}</h3>
        <div class="underline"></div>
        <div class="course">
          <p>{{$course}}</p>
        </div>
        <div class="minutes">
          <p>{{$duration}} Menit</p>
        </div>
        <div class="certificate-id">
          <p>Certificate ID: {{$certificate_id}}</p>
        </div>
        <div class="underline"></div>
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="d-flex  justify-content-center">
              <div class="ketua-jurusan">
                <p>Ketua Komite AAIPI</p>
                <div class="unerline-ttd"></div>
                <div class="cover_image">
                  <img src="{{$tanda_tanggan_komite}}" alt="" class="image_tanda_tangan">
                </div>
                <p class="nama-instruktor">{{$name_komite}}</p>
                <p class="nip-instruktor">NIP. {{$nip_komite}}</p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script>
    document.getElementById('dl-png').onclick = function(){
      const screenshootTable = document.getElementById('example-table');

      html2canvas(screenshootTable).then((canvas) => {
        const base64image = canvas.toDataURL("image/png");
        var anchor = document.createElement('a');
        anchor.setAttribute('href', base64image);
        anchor.setAttribute('download', "my-image.png");
        document.body.appendChild(anchor);
        anchor.click();
        document.body.removeChild(anchor);
      });
    };
  </script>
</body>
</html>
