<body>
  <div class="container">
    <form id="contact" action="" method="post">
      <h1>Liên hệ</h1>
 
      <fieldset>
        <input placeholder="Tên" name="name" type="text" tabindex="1" autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Email" name="email" type="email" tabindex="2">
      </fieldset>
      <fieldset>
        <input placeholder="Phone" name="phone" type="phone" tabindex="3">
      </fieldset>
      <fieldset>
        <textarea name="message" placeholder="Nội dung" tabindex="5"></textarea>
      </fieldset>
 
      <fieldset>
        <button type="submit" name="send" id="contact-submit">Gửi</button>
      </fieldset>
    </form>
  </div>
</body>

<style>
    body{
        font-size: 12px;
        line-height: 30px;
    }

    #contact input {
      font: 400 12px/16px;
      width: 100%;
      border: 1px solid #CCC;
      background: #FFF;
      margin: 10 5px;
      padding: 10px;
    }

    h1 {
      margin-bottom: 30px;
      font-size: 30px;
      text-align: center;
      color: #116A7B;
    }
 
    #contact {
      background: #fff;
      padding: 25px;
      margin: 50px 0;
    }
    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }
 
    textarea {
      height: 100px;
      max-width: 100%;
      resize: none;
      width: 100%;
    }
 
    button {
      cursor: pointer;
      width: 100%;
      border: none;
      background:  #fff;
      color: black;
      margin: 0 0 5px;
      padding: 10px;
      font-size: 20px;
    }
 
    button:hover {
      background-color: #116A7B;
      color: #ECE5C7;
    }
</style>