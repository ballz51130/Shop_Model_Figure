<?php
/**
 * Shared security helpers. Loaded from conn/conn.php so every page has them.
 */

const UPLOAD_MAX_BYTES = 5242880; // 5 MB
const UPLOAD_IMAGE_TYPES = [
    IMAGETYPE_JPEG => 'jpg',
    IMAGETYPE_PNG  => 'png',
    IMAGETYPE_GIF  => 'gif',
    IMAGETYPE_WEBP => 'webp',
];

// Harden the session cookie before any page calls session_start().
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', '1');
    }
}

function sec_session_start()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/** Redirect to the login page and stop. */
function sec_deny($loginUrl)
{
    header('Location: ' . $loginUrl);
    exit;
}

/** Path from the current script to the login page (works from any depth). */
function sec_login_url()
{
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? '');
    $root = str_replace('\\', '/', dirname(__DIR__));
    $rel = ltrim(substr(dirname($script), strlen($root)), '/');
    $depth = $rel === '' ? 0 : substr_count($rel, '/') + 1;
    return str_repeat('../', $depth) . 'login/login.php';
}

/** Current logged-in user id, or 0. */
function current_user_id()
{
    sec_session_start();
    return isset($_SESSION['User']) ? (int)$_SESSION['User'] : 0;
}

function is_admin()
{
    sec_session_start();
    return current_user_id() > 0 && ($_SESSION['role'] ?? '') === 'Admin';
}

/** Require any logged-in user; returns their id. */
function require_login()
{
    $uid = current_user_id();
    if ($uid <= 0) {
        sec_deny(sec_login_url());
    }
    return $uid;
}

/** Require an administrator session. */
function require_admin()
{
    if (!is_admin()) {
        sec_deny(sec_login_url());
    }
    return current_user_id();
}

/** HTML-escape a value for output. */
function e($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/** True when the order belongs to the user. */
function user_owns_order($conn, $orderId, $userId)
{
    $orderId = (int)$orderId;
    $userId = (int)$userId;
    $res = mysqli_query($conn, "SELECT 1 FROM orders WHERE O_ID = $orderId AND U_ID = $userId LIMIT 1");
    return $res && mysqli_num_rows($res) > 0;
}

/**
 * Validate an uploaded image and store it under $dir with a random name.
 * Returns the stored file name, '' when no file was sent, or false when the
 * upload is not a valid image. The client-supplied file name is never used.
 */
function store_uploaded_image($field, $dir)
{
    if (!isset($_FILES[$field]) || !is_array($_FILES[$field])) {
        return '';
    }
    $file = $_FILES[$field];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE || ($file['name'] ?? '') === '') {
        return '';
    }
    if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
        return false;
    }
    if ($file['size'] <= 0 || $file['size'] > UPLOAD_MAX_BYTES) {
        return false;
    }
    $info = @getimagesize($file['tmp_name']);
    if ($info === false || !isset(UPLOAD_IMAGE_TYPES[$info[2]])) {
        return false;
    }
    $name = bin2hex(random_bytes(16)) . '.' . UPLOAD_IMAGE_TYPES[$info[2]];
    $target = rtrim($dir, '/\\') . '/' . $name;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
        return false;
    }
    return $name;
}

/** Stop the request after a rejected upload and send the user back. */
function upload_rejected()
{
    echo "<script type='text/javascript'>alert('ไฟล์รูปภาพไม่ถูกต้อง (jpg, png, gif, webp ไม่เกิน 5MB)');history.back();</script>";
    exit;
}
