<?php

    // namespaces
    namespace Modules\Images;

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
         * _secure
         * 
         * @access protected
         * @param  String $full
         * @return void
         */
        protected function _secure($full)
        {
            /**
             * Validation
             * 
             */

            // grab configuration settings
            $config = \Modules\Images::getConfig();

            // ensure specified path is valid path
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
        }

        /**
         * fit
         * 
         * @access public
         * @param  Integer $width
         * @param  Integer $height
         * @return void
         */
        public function fit($width, $height)
        {
            // fit-setup
            $path = encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);
            $dimensions = ($width) . '*' . ($height);

            /**
             * Ensure the path being accessed is okay to be transformed;
             * access the mime
             */
            $this->_secure($full);
            $mime = mime_content_type($full);

            // grab configuration settings
            $config = \Modules\Images::getConfig();

            /**
             * Ensure the pixels specified is valid, and a wildcard isn't
             * specified
             */
            if (
                !in_array($dimensions, $config['sizes']['fit'])
                && !in_array('*', $config['sizes']['fit'])
            ) {

                // error out
                throw new \Exception(
                    'Invalid dimensions specified for call on path *' .
                    ($full) . '*'
                );
            }

            /**
             * Resize (to the maximum)
             *
             */

            // create instance; resize it; free memory
            $image = (new \Image($full));
            $blob = $image->fit($width, $height);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.fit-' . ($dimensions) . '.';
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
         * maximum
         * 
         * @access public
         * @param  Integer $max
         * @return void
         */
        public function maximum($max)
        {
            // square-setup
            $path = encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);

            /**
             * Ensure the path being accessed is okay to be transformed;
             * access the mime
             */
            $this->_secure($full);
            $mime = mime_content_type($full);

            // grab configuration settings
            $config = \Modules\Images::getConfig();

            /**
             * Ensure the pixels specified is valid, and a wildcard isn't
             * specified
             */
            if (
                !in_array($max, $config['sizes']['maximum'])
                && !in_array('*', $config['sizes']['maximum'])
            ) {

                // error out
                throw new \Exception(
                    'Invalid pixels specified for <maximum> call on path *' .
                    ($full) . '*'
                );
            }

            /**
             * Resize (to the maximum)
             *
             */

            // create instance; resize it; free memory
            $image = (new \Image($full));
            $blob = $image->maximum($max);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.max-' . ($max) . '.';
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
         * minimum
         * 
         * @access public
         * @param  Integer $min
         * @return void
         */
        public function minimum($min)
        {
            // square-setup
            $path = encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);

            /**
             * Ensure the path being accessed is okay to be transformed;
             * access the mime
             */
            $this->_secure($full);
            $mime = mime_content_type($full);

            // grab configuration settings
            $config = \Modules\Images::getConfig();

            /**
             * Ensure the pixels specified is valid, and a wildcard isn't
             * specified
             */
            if (
                !in_array($min, $config['sizes']['minimum'])
                && !in_array('*', $config['sizes']['minimum'])
            ) {

                // error out
                throw new \Exception(
                    'Invalid pixels specified for <minimum> call on path *' .
                    ($full) . '*'
                );
            }

            /**
             * Resize (to the minimum)
             *
             */

            // create instance; resize it; free memory
            $image = (new \Image($full));
            $blob = $image->minimum($min);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.min-' . ($min) . '.';
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
            $full = (APP) . '/webroot' . ($path);

            /**
             * Ensure the path being accessed is okay to be transformed;
             * access the mime
             */
            $this->_secure($full);
            $mime = mime_content_type($full);

            // grab configuration settings
            $config = \Modules\Images::getConfig();

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

            // create instance; square it; free memory
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
            $formatted = ($name) . '.squ-' . ($pixels) . '.';
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
