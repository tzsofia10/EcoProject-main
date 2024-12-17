const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");
const pointsContainer = document.getElementById("pointsContainer");

// Játék paraméterek
const player = { x: 50, y: 350, width: 30, height: 30, color: "red", speed: 5, dx: 0, dy: 0 };
let score = 0;
const pointImagesPath = "./images"; // Képek mappája
const pointImages = ["point1.jpg", "point2.jpg", "point3.png"]; // Képnevek

// Pontok létrehozása
function generatePoints(count) {
    const pointSize = 20; // Pont mérete (20x20 pixel például)
    const canvasRect = canvas.getBoundingClientRect(); // Canvas pozíciója az oldalon

    for (let i = 0; i < count; i++) {
        const pointDiv = document.createElement("div");
        pointDiv.classList.add("point");

        // Pozíció generálása kizárólag a canvas területén belül
        const x = Math.random() * (canvas.width - pointSize); // X pozíció
        const y = Math.random() * (canvas.height - pointSize); // Y pozíció

        // Pont stílus beállítása
        pointDiv.style.position = "absolute";
        pointDiv.style.left = `${canvasRect.left + x}px`;
        pointDiv.style.top = `${canvasRect.top + y}px`;
        pointDiv.style.width = `${pointSize}px`;
        pointDiv.style.height = `${pointSize}px`;

        // Háttérkép hozzárendelése
        const randomImage = pointImages[Math.floor(Math.random() * pointImages.length)];
        pointDiv.style.backgroundImage = `url('${pointImagesPath}/${randomImage}')`;
        pointDiv.style.backgroundSize = "cover";

        // Pont hozzáadása a dokumentumhoz
        pointsContainer.appendChild(pointDiv);
    }
}


// Játékos rajzolása
const playerImage = new Image(); // Kép objektum létrehozása
playerImage.src = './images/idle1.png'; // Kép elérési útja

function drawPlayer() {
    ctx.drawImage(playerImage, player.x, player.y, player.width, player.height); // Kép rajzolása
}


// Pontok összegyűjtése
function collectPoints() {
    const points = document.querySelectorAll(".point");
    points.forEach(point => {
        const rect = point.getBoundingClientRect();
        const playerRect = canvas.getBoundingClientRect();

        const pointX = rect.left - playerRect.left;
        const pointY = rect.top - playerRect.top;

        if (
            player.x < pointX + 20 &&
            player.x + player.width > pointX &&
            player.y < pointY + 20 &&
            player.y + player.height > pointY
        ) {
            point.remove();
            score++;
        }
    });
}

// Pontszám megjelenítése
function drawScore() {
    ctx.fillStyle = "black";
    ctx.font = "20px Arial";
    ctx.fillText(`Score: ${score}`, 10, 20);
}

// Játék frissítése
function update() {
    player.x += player.dx;
    player.y += player.dy;

    // Határok ellenőrzése
    if (player.x < 0) player.x = 0;
    if (player.x + player.width > canvas.width) player.x = canvas.width - player.width;
    if (player.y < 0) player.y = 0;
    if (player.y + player.height > canvas.height) player.y = canvas.height - player.height;

    collectPoints();
}

// Játék rajzolása
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawPlayer();
    drawScore();
}

// Animációs ciklus
function gameLoop() {
    update();
    draw();
    requestAnimationFrame(gameLoop);
}

// Billentyűzet események
function handleKeyDown(e) {
    if (e.key === "ArrowRight") player.dx = player.speed;
    if (e.key === "ArrowLeft") player.dx = -player.speed;
    if (e.key === "ArrowUp") player.dy = -player.speed;
    if (e.key === "ArrowDown") player.dy = player.speed;
}

function handleKeyUp(e) {
    if (["ArrowRight", "ArrowLeft"].includes(e.key)) player.dx = 0;
    if (["ArrowUp", "ArrowDown"].includes(e.key)) player.dy = 0;
}

document.addEventListener("keydown", handleKeyDown);
document.addEventListener("keyup", handleKeyUp);

// Játék indítása
generatePoints(50);
gameLoop();
