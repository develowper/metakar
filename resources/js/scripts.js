import {
    Sidenav,
    initTE,
    Carousel,
    Datepicker,
    Select,
    Timepicker,
    Dropdown,
    Ripple,
    Toast,
    Tooltip,
    Popover,
    Input,
    Alert,
} from "tw-elements";


document.addEventListener("DOMContentLoaded", function (event) {


    try {
        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
            document
                .querySelector('meta[name="theme-color"]')
                .setAttribute("content", "#0B1120");
        } else {
            document.documentElement.classList.remove("dark");
        }
    } catch (_) {
    }


});

window.tailwindElements = () => {

    // if (!window.Select) {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-te-toggle="tooltip"]'));
    tooltipTriggerList.map((tooltipTriggerEl) => new Tooltip(tooltipTriggerEl));
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-te-toggle="popover"]'));
    popoverTriggerList.map((popoverTriggerList) => new Popover(popoverTriggerList));

    if (!window.Dropdown) {
        window.Dropdown = Dropdown;
        initTE({Dropdown});

    }
    window.Popover = Popover;
    window.Tooltip = Tooltip;
    window.Select = Select;
    window.Alert = Alert;
    window.Toast = Toast;
    window.Sidenav = Sidenav;
    initTE({Popover, Tooltip, Ripple, Input, Select, Alert, Toast, Sidenav});
    document.querySelectorAll("[data-te-input-notch-ref]").forEach(el => el.setAttribute("dir", "ltr"))
    // document.querySelectorAll("[data-te-input-notch-leading-ref]").forEach(el => el.classList.add('hidden'))
    // document.querySelectorAll("[data-te-input-notch-middle-ref]").forEach(el => el.classList.add('hidden'))
    // document.querySelectorAll("[data-te-input-notch-trailing-ref]").forEach(el => el.classList.add('hidden'))
    document.querySelectorAll("[data-te-input-notch-ref]").forEach(el => el.innerHTML = '')


    window.Alert = Alert.getInstance(document.getElementById('alert'));
    window.Toast = Toast.getInstance(document.getElementById('toast'));


    window.Sidenav = Sidenav.getInstance(document.getElementById("sidenav-1"));
    // }

}
