    <section class="contact_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                        <div class="contact_content">
                            <h2>Contact Us</h2>
                            <a href="{{route('dashboard')}}">Home</a>
                            <span><i class="fa-solid fa-chevron-right"></i></span>
                            <a class="fw-bold" href="">Contact Us</a>
                        </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_question">
                        <div class="accordion" id="accordionExample">
                            <h3>People Usually Ask These Questions</h3>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How do I place an order?
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>To place an order</strong>, simply browse our products, select your desired item, choose size/quantity, and click "Add to Cart". Then go to your cart and proceed to checkout by entering your shipping and payment details.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What payment methods do you accept?
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>We accept multiple payment options</strong> including Credit/Debit Cards, bKash, Nagad, Rocket, and Cash on Delivery (COD) for selected areas.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   Is Cash on Delivery available?
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Yes, Cash on Delivery is available</strong> for selected locations. You can check availability by entering your delivery address at checkout.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                   How can I track my order?
                                </button>
                                </h2>
                                <div id="collapsefour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Once your order is shipped, you will receive a tracking number via email or SMS. You can track your order on our "Order Tracking" page using that number.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                   Can I change or cancel my order after placing it?
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can change or cancel your order within 1 hour of placing it by contacting our support team via live chat or call.
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                   What is your return and refund policy?
                                </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>We offer a 7-day return policy</strong> for unused, undamaged products. Refunds will be processed within 5–7 working days after we receive and inspect the returned item.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact_form">
                        <form action="/submit" method="POST">
                            <ul>
                                <li><h3>Send Us a Message</h3></li>

                                <li>
                                    <div>
                                        <label for="name">Your Name</label>
                                    </div>
                                    <div>
                                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <label for="email">Your Email</label>
                                    </div>
                                    <div>
                                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <label for="message">Your Message</label>
                                    </div>
                                    <div>
                                        <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
                                    </div>
                                </li>

                                <li>
                                    <button type="submit">Submit</button>
                                </li>
                            </ul>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>