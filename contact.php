<?php include 'header.php' ?>

<div class="row contact-wpr ms-0 ">
    <div class="contact-section col-md-6">
        <div class="heading-contact">
            <!-- <div class="subtitle-text">Questions?</div> -->
            <h2>CONTACT US</h2>
            <div class="paragraph-contact">Fill out the form to attend the most anticipated events in the city and get your tickets for the best night party today for you and your friends.</div>
        </div>

        <div class="mask-contact w-slider-mask">

            <div class="content-contact">
                <h4>Noida, UP</h4>
                <div class="contact-info margin-top">
                    <div class="icon-info">location_on</div>
                    <div class="text-info">H-15, BSI Building, Sector-63, India.</div>
                </div>
                <div class="contact-info">
                    <div class="icon-info">phone</div>
                    <a href="tel:+91912425XXXX" class="link-info">+91 912 425 XXXX</a>
                </div>
                <div class="contact-info none-margin">
                    <div class="icon-info">email</div>
                    <a href="mailto:info@club.com" class="link-info">info@club.com</a>
                </div>
            </div>
        </div>


    </div>
    <div class="contact-email-form col-md-6">
        <div class="form w-form">
            <form id="form" method="post">
                <h3 class="form-heading">Want to Enquire?</h3>
                <div class="input-flex">
                    <input class="input-contact-form w-input" maxlength="256" name="Name" data-name="Your Name" placeholder="Your name*" type="text" id="Your-Name" required="" />
                    <input class="input-contact-form w-input" maxlength="256" name="PhoneNumber" data-name="Phone Number" placeholder="Phone number*" type="tel" id="Phone-Number" required="" />
                </div>
                <div class="input-flex">
                    <input class="input-contact-form w-input" maxlength="256" name="Email" data-name="Email" placeholder="Email*" type="email" id="Email" required="" />
                    <input class="input-contact-form w-input" maxlength="256" name="People" data-name="No. of people" placeholder="No. of people*" type="number" id="No.-of-people" required="" />
                </div>
                <div class="textarea">
                    <textarea placeholder="Your message" maxlength="5000" id="Your-message" name="Message" data-name="Your message" class="textarea-contact w-input"></textarea>
                </div>
                <button type="submit" name="submit" id="submit" class="submit-button w-button">Send</button>
                <!-- <div id="msg" style="color: green; margin-top: 15px;"></div> -->
            </form>

        </div>
    </div>
</div>


<script>
    jQuery('#form').on('submit', function(e) {
        e.preventDefault();
        jQuery('#submit').html('Please wait').attr('disabled', true);

        jQuery.ajax({
            url: 'submit.php',
            type: 'post',
            data: jQuery('#form').serialize(),
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent',
                            text: 'Thank you for contacting us!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Message Not Sent',
                            text: result.error || 'Please try again!',
                        });
                    }
                } catch (err) {
                    console.error('Invalid JSON response', response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred.',
                    });
                }

                jQuery('#submit').html('Send Message').attr('disabled', false);
                jQuery('#form')[0].reset();
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to submit the form.',
                });
                jQuery('#submit').html('Send Message').attr('disabled', false);
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php include 'footer.php' ?>