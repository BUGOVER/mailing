/** @format */

export const csrf = document.head.querySelector("meta[name=\"csrf-token\"]").
    getAttribute("content");

import axios from "axios";

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.common["X-CSRF-TOKEN"] = csrf;
