<?php

    // namespace
    namespace ImagesModule;

    /**
     * ImagesController
     * 
     * @extends \Turtle\Controller
     * @final
     */
    final class ImagesController extends \Turtle\Controller
    {
        /**
         * resize
         * 
         * @access public
         * @param  Integer $max
         * @return void
         */
        public function resize($max)
        {
            // square-setup
            $path = encode($_GET['path']);


            $mime = 'image/jpeg';



            // ensure max specified is valid
/*
            $config = Request::getConfig();
            $sizes = $config['images']['resize'];
*/

            // check if resize can be done
/*
            if (!in_array($max, $sizes)) {
                throw new Exception(
                    'Resize dimension *' . ($max) . '* is invalid for file *' .
                    ($path) . '*'
                );
            }
*/

            /**
             * Resize
             *
             */

            // load library; create instance; resize it; free memory
            require_once APP . '/vendors/PHP-ImageHelper/Image.class.php';
            $image = (new \Image(APP . '/webroot/modules/files' . ($path)));
            $blob = $image->resize($max);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($path);
            $name = $info['filename'];
            $formatted = ($name) . '.r' . ($max) . '.';
            $formatted .= $info['extension'];
            unset($image);

            // write it to storage
            file_put_contents(
                APP . '/webroot/modules/files/' . $formatted,
                $blob
            );

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('raw', $blob);
        }

        /**
         * square
         * 
         * @access public
         * @param  Integer $pixels
         * @return void
         */
        public function square($pixels)
        {
            // square-setup
            $path = encode($_GET['path']);

            // ensure specified path is valid path
            

            // ensure specified path is valid type
            $mime = 'image/jpeg';
            

            // ensure the pixels specified is valid
            

/*
            $config = Request::getConfig();
            $sizes = $config['images']['square'];
*/

            // check if resize can be done
/*
            if (!in_array($pixels, $sizes)) {
                throw new Exception(
                    'Square pixels *' . ($pixels) . '* is invalid for file *' .
                    ($path) . '*'
                );
            }
*/

            /**
             * Squaring
             *
             */

            // load library; create instance; square it; free memory
            require_once APP . '/vendors/PHP-ImageHelper/Image.class.php';
            $image = (new \Image(APP . '/webroot/modules/files' . ($path)));
            $blob = $image->square($pixels);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($path);
            $name = $info['filename'];
            $formatted = ($name) . '.s' . ($pixels) . '.';
            $formatted .= $info['extension'];

            // write it to storage
            file_put_contents(
                APP . '/webroot/modules/files/' . $formatted,
                $blob
            );

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('raw', $blob);
        }
    }
