<x-landing-layout headerBg="white">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <div id="studentDashboard" data-user="{{json_encode(auth()->user())}}"></div>
</x-landing-layout>
