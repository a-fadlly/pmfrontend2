var pmServer = "http://192.168.1.244:8000";

function getCookie(name) {
  function escape(s) {
    return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, "\\$1");
  }
  var match = document.cookie.match(
    RegExp("(?:^|;\\s*)" + escape(name) + "=([^;]*)")
  );
  return match ? match[1] : null;
}

var oResponse = null;
var httpStatus = null;

function pmRestRequest(method, endpoint, asynchronous, oVars, func) {
  asynchronous = typeof asynchronous === "undefined" ? false : asynchronous;
  oParams = typeof oParams === "undefined" ? null : oParams;
  func = typeof func === "undefined" ? null : func;

  while (!getCookie("access_token")) {
    pmRestLogin();
  }

  if (typeof XMLHttpRequest != "undefined") {
    var req = new XMLHttpRequest();
  } else {
    try {
      var req = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
      alert("Error: This browser does not support XMLHttpRequest.");
      return;
    }
  }

  req.open(method, pmServer + endpoint, asynchronous);
  req.setRequestHeader("Authorization", "Bearer " + getCookie("access_token"));
  sVars = null;
  method = method.toUpperCase().trim();

  switch (method) {
    case "GET":
    case "DELETE":
      break;
    case "PUT":
      if (oVars) {
        for (var v in oVars) {
          if (oVars.hasOwnProperty(v)) oVars[v] = encodeURIComponent(oVars[v]);
        }
      }
    case "POST":
      var sVars = JSON.stringify(oVars);
      req.setRequestHeader("Content-type", "application/json; charset=utf-8");
      req.setRequestHeader("Content-length", sVars.length);
      break;
    default:
      alert("Error: Invalid HTTP method '" + url + "'.");
      return;
  }

  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      var status = req.status;
      var oResp = null;

      if (req.responseText) {
        oResp = JSON ? JSON.parse(req.responseText) : eval(req.responseText);
      }

      if (!asynchronous) {
        httpStatus = status;
        oResponse = oResp;
      }
      if (status == 401) {
        window.location.href = "login.html";
        return;
      } else if (oResp && oResp.error) {
        var msg =
          "Error code: " +
          oResp.error.code +
          "\nMessage: " +
          oResp.error.message;
        alert(msg);
      } else if (status != 200 && status != 201) {
        alert("HTTP status error: " + req.status);
      }

      if (func) {
        func(oResp, status);
      }
    }
  };

  if (asynchronous) {
    req.timeout = 20000;
    req.ontimeout = function () {
      alert("Timed out calling " + $endpoint);
    };
  }
  req.send(sVars);
}

function getCurrentDateTime() {
  const now = new Date();

  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, "0");
  const day = String(now.getDate()).padStart(2, "0");
  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");
  const seconds = String(now.getSeconds()).padStart(2, "0");

  const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
  return formattedDateTime;
}
