<x-app-layout>
    <div id="frame">
        @include('layouts.sidebar')
        <div class="content">
            <div class="blank-wrap">
                <div class="inner">Select contact</div>
            </div>
            <div class="loader d-none">
                <div class="loader-inner">
                    <l-wobble size="45" speed="0.9" color="black"></l-wobble>
                </div>
            </div>
            <div class="contact-profile">
                <img src="{{ asset('image/avatar.jpg') }}" alt="" />
                <p class="contact-name"></p>
                <div class="social-media">
                    <!-- Add social media icons or content here -->
                </div>
            </div>
            <div class="messages">
                <ul>
                    <x-message class="sent" text="Hello"/>
                    <x-message class="replies" text="How u dey "/>
                </ul>
            </div>
            <div class="message-input">
                <form action="" method="POST" class="message-form">
                    @csrf
                    <div class="wrap">
                        <input type="text" autocomplete="off" placeholder="Write your message..."  name="message" class="message-box"/>
                        <button type="submit" class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        @vite('resources/js/app.js')
    </x-slot>
</x-app-layout>
