<?php

    // namespace
    namespace ImagesModule;

    /**
     * ImagesController
     * 
     * @todo    Optimize methods to do validation commonly
     * @extends \Turtle\Controller
     * @final
     */
    final class ImagesController extends \Turtle\Controller
    {
        /**
         * _config
         * 
         * @access protected
         * @return array
         */
        protected function _config()
        {
            // configuration settings
            $config = \Plugin\Config::retrieve();
            $config = $config['TurtlePHP-ImagesModule'];
            return $config;
        }

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

            /**
             * Validation
             * 
             */

            // grab configuration settings
            $config = $this->_config();

            // ensure specified path is valid path
            $full = (APP) . '/webroot' . ($path);
            if (!is_file($full)) {

                // error out
                throw new \Exception(
                    'Path *' . ($full) . '* is not a valid resource.'
                );
            }

            // ensure specified path is valid type
            $mime = mime_content_type($full);
            if (!in_array($mime, $config['mimes'])) {

                // error out
                throw new \Exception(
                    'Path *' . ($full) . '* is an unsupported mime type.'
                );
            }

            /**
             * Ensure the pixels specified is valid, and a wildcard isn't
             * specified
             */
            if (
                !in_array($max, $config['sizes']['resize'])
                && !in_array('*', $config['sizes']['resize'])
            ) {

                // error out
                throw new \Exception(
                    'Invalid pixels specified for <square> call on path *' .
                    ($full) . '*'
                );
            }

            /**
             * Resize
             *
             */

            // load library; create instance; resize it; free memory
            require_once APP . '/vendors/PHP-ImageHelper/Image.class.php';
            $image = (new \Image($full));
            $blob = $image->resize($max);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.r' . ($max) . '.';
            $formatted .= $info['extension'];

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
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

            /**
             * Validation
             * 
             */

            // grab configuration settings
            $config = $this->_config();

            // ensure specified path is valid path
            $full = (APP) . '/webroot' . ($path);
            if (!is_file($full)) {

                // error out
                throw new \Exception(
                    'Path *' . ($full) . '* is not a valid resource.'
                );
            }

            // ensure specified path is valid type
            $mime = mime_content_type($full);
            if (!in_array($mime, $config['mimes'])) {

                // error out
                throw new \Exception(
                    'Path *' . ($full) . '* is an unsupported mime type.'
                );
            }

            /**
             * Ensure the pixels specified is valid, and a wildcard isn't
             * specified
             */
            if (
                !in_array($pixels, $config['sizes']['square'])
                && !in_array('*', $config['sizes']['square'])
            ) {

                // error out
                throw new \Exception(
                    'Invalid pixels specified for <square> call on path *' .
                    ($full) . '*'
                );
            }

            /**
             * Squaring
             *
             */

            // load library; create instance; square it; free memory
            require_once APP . '/vendors/PHP-ImageHelper/Image.class.php';
            $image = (new \Image($full));
            $blob = $image->square($pixels);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.s' . ($pixels) . '.';
            $formatted .= $info['extension'];

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
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
