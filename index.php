<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>

    <style>

        .grid{
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            font-family: sans-serif;
        }
        
        .box{
            display: inline-block;
            padding: 2em;
            border: 1px solid black;
        }

        img{
            width: 200px;
        }

        select{
            display: block;
            margin: 5em auto;
        }
        
    </style>

    <!-- <?php
        // require_once 'data.php';
    ?> -->

    <script>

        function init(){

            new Vue({

                el: '#app',
                data: {

                    albums: [],
                    genres: [],
                    select: '-1'
                },

                methods: {

                    selectGenres: function(){

                        axios.get('data.php', {

                            params: {
                                genre: this.select
                            }
                        }).then(data => {

                            console.log(data.data)
                            this.albums = data.data;
                        })
                    }
                },

                mounted(){

                    axios.get('data.php')
                    .then(res => {

                        // console.log(res.data);

                        res.data.forEach(item => {

                            this.albums.push(item);

                            if (!this.genres.includes(item.genre)){

                                this.genres.push(item.genre);
                            }
                        })
                    })
                }

            });
        };

        document.addEventListener('DOMContentLoaded', init)
    </script>

    <title>Document</title>
</head>
<body>
    <div id="app" class="container">

        <!-- <?php
            // foreach ($db as $album) {
            //     // var_dump($album);

            //     echo '<div class="box">';
            //     echo '<h1>' . $album['title'] . '<h1>';
            //     echo '<h2>' . $album['author'] . '<h2>';
            //     echo '<img src="' . $album['poster'] . '">';
            //     echo '</div>';
            // }
        ?> -->

        <select v-model="select" id="select" v-on:change="selectGenres">
            
            <option value="-1" selected="selected">All</option>
            <option v-for="genre in genres" v-bind:value="genre" >{{ genre }}</option>

        </select>

        <div class="grid">

            <div v-for="album in albums" class="box">
                <h3>{{ album.title }}</h3>
                <h4>{{ album.author }}</h4>
                <img :src="album.poster" alt="">
            </div>
            
        </div>
        
    </div>
</html>