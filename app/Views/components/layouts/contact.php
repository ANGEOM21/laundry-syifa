<div class="contact wow animate__animated animate__fadeInUp" data-wow-delay="0.1s" id="contact">
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate" action="<?= BASEURL ?>/send/email" method="post">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" name="name_your" placeholder="Nama Kamu" required="required" />
                                <p class="help-block"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email_your" name="email_your" placeholder="example@gmail.com" required="required" />
                                <p class="help-block"></p>
                            </div>
                            <div class="control-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text mr-2">+62</div>
                                    </div>
                                    <input type="text" class="form-control" name="nomor_hp_your" id="inlineFormInputGroup" placeholder="8 x x x x x x x">
                                </div>
                                <p class="help-block"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukan Subject" required="required" />
                                <p class="help-block"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Masukan Pesan yang ingin disampaikan" required="required"></textarea>
                                <p class="help-block"></p>
                            </div>
                            <div>
                                <button class="btn" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>