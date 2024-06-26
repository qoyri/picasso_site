document.addEventListener('DOMContentLoaded', (event) => {
    // Les données des œuvres
    let oeuvres = [
        { img: '../assets/image/Femme-assise.jpeg', title: 'Femme asise', desc: 'Cette peinture, réalisée en 1909, représente une femme assise avec une structure géométrique complexe, caractéristique de la période cubiste précoce de Picasso. La forme de la figure est fragmentée et réassemblée en formes abstraites, montrant plusieurs perspectives simultanément.' },
        { img: '../assets/image/Jeune-fille-devant-un-miroir.jpg', title: 'Jeune fille devant un miroir', desc: 'Ce tableau de 1932, "Jeune fille devant un miroir", met en scène la jeune maîtresse de Picasso, Marie-Thérèse Walter. La dualité dans l\'œuvre contraste la jeunesse et la beauté avec la contemplation de la mortalité, représentée par le reflet déformé dans le miroir' },
        { img: '../assets/image/La-femme-qui-pleure.jpeg', title: 'La femme qui pleure', desc: 'La série "La femme qui pleure", dont cette peinture de 1937 fait partie, dépeint Dora Maar, l\'amante et muse de Picasso. La série reflète l\'angoisse et la souffrance de la guerre, inspirée par la guerre civile espagnole et le bombardement de Guernica.'},
        { img: '../assets/image/La-femme-a-la-fleur.jpeg', title: 'La femme à la fleur', desc: '"La femme à la fleur" présente l\'utilisation par Picasso du surréalisme pour exprimer les émotions complexes de ses sujets. Ce tableau montre souvent des traits faciaux exagérés et déformés pour évoquer une intensité psychologique.' },
        { img: '../assets/image/Le-Baiser.jpg', title: 'Le Baiser', desc: '"Le Baiser", peint en 1969, illustre l\'intimité et la passion d\'une étreinte, avec des formes entrelacées caractéristiques de la période tardive de Picasso. L\'utilisation de couleurs vives et de formes simplifiées met en évidence la connexion émotionnelle entre les figures.' },
        { img: '../assets/image/Le-reve.jpg', title: 'Le reve', desc: 'Créé en 1932, "Le rêve" représente Marie-Thérèse Walter de manière stylisée, en mettant en avant sa forme voluptueuse et son sommeil paisible. Le tableau est connu pour ses qualités érotiques et sereines.' },
        { img: '../assets/image/Le-vieux-guitariste-aveugle.jpg', title: 'Le vieux guitariste aveugle', desc: '"Le vieux guitariste aveugle", faisant partie de la période bleue de Picasso (1903-1904), représente un vieux musicien aveugle. Les tons sombres et la figure allongée expriment des thèmes de pauvreté et de désespoir.' },
        { img: '../assets/image/Les-Demoiselles-d-Avignon.jpg', title: 'Les Demoiselles du\u0027Avignon.jpg', desc: 'Ce tableau de 1907 marque un tournant significatif par rapport à la composition traditionnelle, présentant cinq femmes nues aux formes corporelles disjointes et aux visages ressemblant à des masques africains. Il est considéré comme une œuvre pionnière dans le développement du cubisme.' },
        { img: '../assets/image/Nude-in-red-armchair.jpg', title: 'Nude in red armchair.jpg', desc: 'Ce tableau de 1932 représente Marie-Thérèse Walter dans un fauteuil rouge. La sensualité et les courbes fluides reflètent l\'affection de Picasso pour elle, combinées à des éléments surréalistes pour créer une atmosphère onirique.' },

        // Ajoutez les autres œuvres ici
    ];

    // Fonction pour mélanger aléatoirement les œuvres
    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]]; // échange des éléments
        }
    }

    // Mélange des œuvres
    shuffle(oeuvres);

    // Sélection du conteneur où afficher les œuvres
    const container = document.querySelector('#oeuvres-container');
    container.style.flexWrap = "wrap";

    // Génération du HTML pour chaque œuvre
    oeuvres.forEach((oeuvre, index) => {
        let oeuvreElement = document.createElement('div');
        oeuvreElement.className = "col-lg-4 col-md-4 col-sm-12 mb-4";
        oeuvreElement.style.animation = `appear 1.5s ${index*0.2}s both`; // add this line
        oeuvreElement.innerHTML = `
    <a class="d-block border rounded overflow-hidden zoom-on-hover">
        <img src="${oeuvre.img}" class="img-fluid" alt="${oeuvre.title}">
    </a>`;

        oeuvreElement.onclick = () => {
            const oldGrid = document.getElementById("oeuvres-container");
            const newContent = document.getElementById("selected-oeuvre");

            // Prepare new content
            newContent.style.opacity = '0';
            document.getElementById("selected-image").innerHTML = `<img src="${oeuvre.img}" class="img-fluid" alt="${oeuvre.title}">`;
            document.getElementById("selected-title").textContent = oeuvre.title; // add this line
            const wikiText = document.getElementById("wiki-text");
            wikiText.textContent = ''; // clear existing text

            let i = 0, text = oeuvre.desc;
            function typeWriter() {
                if (i < text.length) {
                    wikiText.textContent = text.substring(0, i+1);
                    i++;
                    setTimeout(typeWriter, 50);
                } else {
                    // Show the back button once the typing animation is done.
                    document.getElementById("back-button").style.display = "block";
                }
            }

            typeWriter();

            // Step 1: Opacity transition on the old grid
            oldGrid.style.opacity = '0';

            setTimeout(function() {
                // Step 2: Swap visibility of old grid and new content
                oldGrid.classList.add("d-none");
                newContent.classList.remove("d-none");
                newContent.style.animation = 'expand 0.5s forwards';

                // Step 3: Opacity transition on the new content
                setTimeout(function() {
                    newContent.style.opacity = '1';
                }, 10);

            }, 1500);

        };

        container.appendChild(oeuvreElement);
    });
});

document.getElementById('back-button').onclick = () => {
    const oldContent = document.getElementById("selected-oeuvre");

    // Initiate shrink effect on the old content.
    oldContent.style.animation = 'shrink 0.5s forwards';

    setTimeout(function() {
        // Refresh the page after the animation has ended
        location.reload();
    }, 500); // wait for the duration of the shrink animation before reloading the page
};
