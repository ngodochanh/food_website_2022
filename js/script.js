// dùng để hiển thị navbar cho các kích thước màn hình, khi nhấn list thì chỉ hiển thì navbar còn ẩn profile
var navbar = document.querySelector('.header .flex .navbar');
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

// dùng để hiển thị hồ sơ khi nhấn vào icon user, khi nhấn user thì chỉ hiển thì profile còn ẩn navbar
var profile = document.querySelector('.header .flex .profile');
document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

// tác động đến cửa sổ trình duyệt thì ẩn Nav và Profile
window.onscroll = () => {
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

// dùng để load
function loader() {
    document.querySelector('.loader').style.display = 'none';
}

function fadeOut() {
    setInterval(loader, 1000);
}

window.onload = fadeOut;

// 
document.querySelectorAll('input[type=number]').forEach(input => {
    input.oninput = () => {
        if (input.value.length > input.maxLength) {
            input.value = input.value.slice(0, input.value.maxLength);
        }
    }
});