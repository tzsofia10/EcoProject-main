<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Környezettudatos Weboldal</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tippek.css">

    <script src="script.js"></script>

</head>
<body>
    <header>
        <?php include 'html/navbar.php'; ?>
    </header>

    <main>
        <section id="home">
            <h1>Üdvözlünk a fenntartható weboldalon!</h2>
            <p>A környezettudatosság kulcsfontosságú a fenntartható jövő érdekében. Íme néhány egyszerű, mégis hatékony tipp, amely segíthet a mindennapi életben és a munkahelyeken egyaránt, hogy csökkentsük a környezeti lábnyomunkat:</p>
        </section>
        
    <h2>Tippek hogy környezettudatossabb legyél</h2>

    <div class="container">
        <div class="cards">
            <div class="card">
                <h3>Csökkentsd a műanyag használatot</h3>
                <p>
                    Használj újrahasználható táskákat, palackokat és ételtároló edényeket.
                    Kerüld a műanyag csomagolást és válassz papírból vagy üvegből készült termékeket.
                    Válassz környezetbarát alternatívákat, például bambusz szívószálat, fából készült evőeszközöket.
                </p>
                <img src="imgs/pittogram/1.png" alt="Plastics reduction image">
            </div>
            <!-- 2 -->
            <div class="card">
                <h3>Használj energiatakarékos eszközöket</h3>
                <p>
                    Használj újrahasználható táskákat, palackokat és ételtároló edényeket.
                    Kerüld a műanyag csomagolást és válassz papírból vagy üvegből készült termékeket.
                    Válassz környezetbarát alternatívákat, például bambusz szívószálat, fából készült evőeszközöket.
                </p>
                <img src="imgs/pittogram/2.png" alt="Energy saving image">
            </div>
            
            <!-- 3 -->
            <div class="card">
                <h3>Takarékoskodj vízzel</h3>
                <p>
                    Rövidítsd le a zuhanyzást, és ne hagyd folyni a vizet a csap alatt, amíg nem használod.
                    Használj víztakarékos eszközöket, mint például alacsony vízfogyasztású WC-k és zuhanyfejek.
                    Gyűjtsd a csapvíz a növények öntözésére, ha nem tartalmaz vegyszereket.
                </p>
                <img src="imgs/pittogram/3.png" alt="Water saving image">
            </div>
    
            <!-- 4 -->
            <div class="card">
                <h3>Támogasd a fenntartható közlekedést</h3>
                <p>
                    Használj tömegközlekedést, kerékpárt vagy sétálj, ha teheted, hogy csökkentsd a szén-dioxid kibocsátást.
                    Ha autót használsz, válassz elektromos vagy hibrid járművet.
                    Carpooling: Ossz meg utazásokat barátokkal vagy munkatársakkal, hogy csökkentsd az autók számát az utakon.
                </p>
                <img src="imgs/pittogram/4.png" alt="Sustainable transport image">
            </div>
    
            <!-- 5 -->
            <div class="card">
                <h3>Vásárolj helyi és szezonális termékeket</h3>
                <p>
                    Támogasd a helyi gazdaságot és csökkentsd a szállítási távolságokat, amelyek környezeti hatásokat eredményeznek.
                    Vásárolj szezonális termékeket, amelyek kevesebb energiát és erőforrást igényelnek a termesztésük során.
                </p>
                <img src="imgs/pittogram/5.png" alt="Local products image">
            </div>
            
            <!-- 6 -->
            <div class="card">
                <h3>Komposztálj</h3>
                <p>
                    Komposztálj otthon, hogy csökkentsd a hulladékot és gazdag tápanyagokat adj a kertednek.
                    Ha nem tudsz komposztálni, keresd fel a helyi komposztáló központokat vagy programokat.
                </p>
                <img src="imgs/pittogram/6.png" alt="Composting image">
            </div>
    
            <!-- 7 -->
            <div class="card">
                <h3>Használj fenntarthatóbb anyagokat</h3>
                <p>
                    Válassz környezetbarát, újrahasznosított vagy biológiailag lebomló anyagokat a háztartásban és a munkahelyen.
                    Vásárolj bio- vagy fenntartható módon termesztett termékeket, mint például organikus élelmiszereket és fenntartható forrásból származó papírárut.
                </p>
                <img src="imgs/pittogram/7.png" alt="Sustainable materials image">
            </div>
    
            <!-- 8 -->
            <div class="card">
                <h3>Tartsd karban a gépeket és eszközöket</h3>
                <p>
                    Szervizeld rendszeresen a gépeket, hogy azok hatékonyabban működjenek és hosszabb ideig szolgáljanak.
                    Ne dobj ki működőképes dolgokat, hanem javítsd meg őket, ha lehetséges.
                </p>
                <img src="imgs/pittogram/8.png" alt="Maintenance image">
            </div>
            
            <!-- 9 -->
            <div class="card">
                <h3>Zöldítsd a környezeted</h3>
                <p>
                    Ültess fákat és növényeket otthon, mert ezek segítenek a szén-dioxid felszívásában és tisztítják a levegőt.
                    Ha van kerted, építs szemetes kertet, ahol a zöld hulladékot újrahasznosíthatod.
                </p>
                <img src="imgs/pittogram/9.png" alt="Greening the environment image">
            </div>
            
            <!-- 10 -->
            <div class="card lastCard">
                <h3>Növeld az informáltságot</h3>
                <p>
                    Tájékozódj a környezetvédelemről és terjeszd a fenntarthatóság fontosságát barátaid, családod és kollégáid körében.
                    Vegyél részt helyi környezetvédelmi programokban, önkéntes akciókban, hogy aktívan hozzájárulj a változáshoz.
                </p>
                <img src="imgs/pittogram/10.png" alt="Awareness image">
            </div>
        </div>
    </div>
    
    </main>

    <footer>
      <?php include 'html/footer.html'; ?>
    </footer>

</body>
</html>
