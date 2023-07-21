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
    Modal,
} from "tw-elements";
import axios, {isCancel, AxiosError} from 'axios';

window.axios = axios.create();
window.onload = (event) => {

    // window.tailwindElements();
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


}

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
    window.Modal = Modal;
    initTE({Popover, Tooltip, Ripple, Input, Select, Alert, Toast, Sidenav, Modal,});
    document.querySelectorAll("[data-te-input-notch-ref]").forEach(el => el.setAttribute("dir", "ltr"))
    document.querySelectorAll("[data-te-input-notch-ref]").forEach(el => el.innerHTML = '')

    const alertEl = document.getElementById('alert');
    const toastEl = document.getElementById('toast');
    const modalEl = document.getElementById('modal');
    const sideNavEl = document.getElementById('sidenav-1');
    if (alertEl)
        window.Alert = Alert.getInstance(alertEl);
    if (toastEl)
        window.Toast = Toast.getInstance(toastEl);
    if (modalEl)
        window.Modal = new Modal(modalEl);

    if (sideNavEl)
        window.Sidenav = Sidenav.getInstance(sideNavEl);
    // }
    initSidenav();
}

window.initSidenav = () => {

    let innerWidth = null;
    const setMode = (e) => {
        // Check necessary for Android devices
        if (window.innerWidth === innerWidth) {
            return;
        }

        innerWidth = window.innerWidth;

        if (window.innerWidth < window.Sidenav.getBreakpoint("md")) {
            window.Sidenav.changeMode("over");
            window.Sidenav.hide();
        } else {
            window.Sidenav.changeMode("side");
            window.Sidenav.show();
        }
    };

    if (window.innerWidth < window.Sidenav.getBreakpoint("md")) {
        setMode();
    }

    window.addEventListener("resize", setMode);
}