//Code pour la carte
window.addEventListener("DOMContentLoaded", function() {

    const xhttp = new XMLHttpRequest();

    mapboxgl.accessToken = 'PLACEZ VOTRE TOKEN ICI';
    const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v11',
    center: [2.408, 47.900],
    zoom: 5,
    maxZoom: 6,
    minZoom: 2,
    });

    map.on('load', () => {

        //Init des layers pour les racines ils sont vides pour l'instant et seront remplis via les requêtes Ajax
        map.addSource('root', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': []
            }
            });
        map.addSource('root-line', {
            'type': 'geojson',
            'data': {
            'type': 'FeatureCollection',
            'features': []
            }
        });

        map.addLayer({
            'id': 'root',
            'type': 'circle',
            'source': 'root',
            'filter': ['!', ['has', 'point_count']],
            'paint': {
                'circle-color': ['get', 'color'],
                'circle-radius': 20,
            }
        });

        map.addLayer({
            'id': 'root-line',
            'type': 'line',
            'source': 'root-line',
            'paint': {
                'line-width': 3,
                'line-color': '#A64D2D',
            }
        });

        //code pour les points de type légende
        map.addSource('legend', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': getPointsArray('legend'),
            },
            cluster: true,
            clusterMaxZoom: 14,
            clusterRadius: 50
        });
        
        map.addLayer({
            'id': 'legend',
            'type': 'circle',
            'source': 'legend',
            'filter': ['!', ['has', 'point_count']],
            'paint': {
                'circle-color': '#A64D2D',
                'circle-radius': 10,
            }
        });

        map.addLayer({
            'id': 'cluster-legend',
            'type': 'circle',
            'source': 'legend',
            'filter': ['has', 'point_count'],
            'paint': {
                'circle-color': '#A64D2D',
                'circle-radius': 20,
            }
        });

        map.addLayer({
            'id': 'number-legend',
            'type': 'symbol',
            'source': 'legend',
            'filter': ['has', 'point_count'],
            'layout': {
                'text-field': ['get', 'point_count_abbreviated'],
                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                'text-size': 20,
            },
            paint: {
              "text-color": "#ffffff"
            }
        });

        //code pour les points de type histoire
        map.addSource('history', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': getPointsArray('history'),
            },
            cluster: true,
            clusterMaxZoom: 14,
            clusterRadius: 50
        });
        
        map.addLayer({
            'id': 'history',
            'type': 'circle',
            'source': 'history',
            'filter': ['!', ['has', 'point_count']],
            'paint': {
                'circle-color': '#CDD977',
                'circle-radius': 10,
            }
        });

        map.addLayer({
            'id': 'cluster-history',
            'type': 'circle',
            'source': 'history',
            'filter': ['has', 'point_count'],
            'paint': {
                'circle-color': '#CDD977',
                'circle-radius': 20,
            }
        });

        map.addLayer({
            'id': 'number-history',
            'type': 'symbol',
            'source': 'history',
            'filter': ['has', 'point_count'],
            'layout': {
                'text-field': ['get', 'point_count_abbreviated'],
                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                'text-size': 20,
            },
            'paint': {
              "text-color": "#291800"
            }
        });

        //Le layer des points historiques est rendu invisible à l'initialisation
        changeVisibility('history','none');

        //Code pour changer le switch de la carte de la page d'index
        const mapSwitch = document.querySelector('#map-switch');

        if (mapSwitch) {

            mapSwitch.onclick = function(){

                //sans un Timeout le test de check de l'input renvoi vrai à chaque fois 
                setTimeout(() => {  
                    if (document.querySelector('#map-switch input').checked) {

                        //Ce morceau permet aussi de changer le texte au dessus du switch
                        document.querySelector('#map-switch p').innerHTML = "Histoire";
                        changeVisibility('history','visible');
                        changeVisibility('legend','none');

                    }else{

                        document.querySelector('#map-switch p').innerHTML = "Légendes";
                        changeVisibility('history','none');
                        changeVisibility('legend','visible');

                    }
                }, 100);
            };
        }

        addActions('legend');
        addActions('history');
        addActions('root')

        //actions de fermeture des layers de root
        map.on('click', function(e) {
            if (e.defaultPrevented === false) {

                //reset du switch
                document.querySelector('#map-switch').classList.remove('hide');
                document.querySelector('#map-switch input').checked = false;
                document.querySelector('#map-switch p').innerHTML = "Légendes";
                
                //vide les layers de root
                map.getSource('root').setData({
                    "type": "FeatureCollection",
                    "features": {}
                });
        
                map.getSource('root-line').setData({
                    "type": "FeatureCollection",
                    "features": {}
                });

                //rend le layer des points de légende visible
                changeVisibility('legend','visible');
            }
        });
        
    });


    //Fonction qui donne une liste de point selon le type demandé soit légende (legend) ou histoire (history)
    function getPointsArray(type) {

        let liste = [];

        for (let i = 0; i < Points.length; i++) {

            if(Points[i].type == type){

                //Variable pour le contenu des popups selon les points
                let htmlContent = `<h1>${Points[i].title}</h1><h3>${Points[i].undertitle}</h3><div class="popup-img"><img src="${Points[i].img}" /></div><div class="popup-text">${Points[i].content}</div><a class="button" href="${Points[i].url}">Lire la suite</a>`;

                let data = {
                    'type': 'Feature',
                    'properties': {
                    'description': htmlContent,
                    'id': Points[i].id
                    },
                    'geometry': {
                    'type': 'Point',
                    'coordinates': [Points[i].longitude, Points[i].latitude]
                    }
                };

                liste.push(data);

            }

        }

        return liste;

    }

    //Fonction pour changer la visiblité des layers de légende et d'histoire
    function changeVisibility(type, value) {

        map.setLayoutProperty(type, 'visibility', value);
        map.setLayoutProperty('cluster-'+type, 'visibility', value);
        map.setLayoutProperty('number-'+type, 'visibility', value);
    }

    //Fonction pour les actions des layers de légende et d'histoire
    function addActions(type) {

        //Code pour les popups des points
        map.on('click', type, (e) => {
            e.preventDefault();

            // Copie les coordonnées
            const coordinates = e.features[0].geometry.coordinates.slice();
            const description = e.features[0].properties.description;
            
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {

                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;

            }
            
            new mapboxgl.Popup({closeButton : false})
            .setLngLat(coordinates)
            .setHTML(description)
            .addTo(map);


            //Requête ajax lors du click d'un point pour montrer les racines
            xhttp.onload = function() {

                //Invisibilité du switch
                document.querySelector('#map-switch').classList.add('hide');

                //Invisibilité des autres layers
                changeVisibility('legend','none');
                changeVisibility('history','none');

                //Passage de la réponse en JSON
                //L'on récupère le même type d'array de point que celui du localize script
                let result = JSON.parse(this.responseText);
                let liste = [];
                let lineliste = [];

                //boucle for pour les lignes
                for (let i = 1; i < result.length; i++) {
    
                    let data = {
                        'type': 'Feature',
                        'geometry': {
                            'type': 'LineString',
                            'coordinates': [
                                [result[0].longitude, result[0].latitude],
                                [result[i].longitude, result[i].latitude]
                            ]
                        }
                    };
    
                    lineliste.push(data);
    
                }

                //boucle for pour les points
                for (let i = 0; i < result.length; i++) {

                    //Changement de la couleur du point selon le type
                    let color = '#CDD977';
        
                    if(result[i].type == 'legend'){
                        color = '#A64D2D';
                    }
        
                        let htmlContent = `<h1>${result[i].title}</h1><h3>${result[i].undertitle}</h3><div class="popup-img"><img src="${result[i].img}" /></div><div class="popup-text">${result[i].content}</div><a class="button" href="${result[i].url}">Lire la suite</a>`;
        
                        let data = {
                            'type': 'Feature',
                            'properties': {
                                'description': htmlContent,
                                'id': result[i].id,
                                'color': color,
                                'img': result[i].img,
                            },
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [result[i].longitude, result[i].latitude]
                            }
                        };
        
                        liste.push(data);
        
        
                }

                //Mise à jour des infos dans le layer des racines
                map.getSource('root').setData({
                    "type": "FeatureCollection",
                    "features": liste
                });

                map.getSource('root-line').setData({
                    "type": "FeatureCollection",
                    "features": lineliste
                });
            }
        
            xhttp.open("POST", ajaxurl+'?action=get_roots');
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("pointid="+e.features[0].properties.id);
        });
            
        //Change le cursor en pointeur sur les points
        map.on('mouseenter', type, () => {
            map.getCanvas().style.cursor = 'pointer';
        });
        
        //Rechange le curseur en grab en dehors des points
        map.on('mouseleave', type, () => {
            map.getCanvas().style.cursor = '';
        });

    }
    

}, false);