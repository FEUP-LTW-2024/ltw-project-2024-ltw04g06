function hideUserInfo(imgElement) {
    const userInfo = imgElement.nextElementSibling.querySelector('.user-info');
    userInfo.classList.remove('visible');
}

function showUserInfo(imgElement) {
    const userInfo = imgElement.nextElementSibling.querySelector('.user-info');
    userInfo.classList.add('visible');
}