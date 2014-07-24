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
         * _effects
         *
         * @var    array
         * @access protected
         * @static
         */
        protected $_effects = array(
            'bw',
            'gotham',
            'lomo'
        );

        /**
         * _encode
         * 
         * @access protected
         * @param  mixed $mixed
         * @return array
         */
        protected function _encode($mixed)
        {
            if (is_array($mixed)) {
                foreach ($mixed as $key => $value) {
                    $mixed[$key] = self::_encode($value);
                }
                return $mixed;
            }
            return htmlentities($mixed, ENT_QUOTES, 'UTF-8');
        }

        /**
         * _secure
         * 
         * @access protected
         * @param  string $fullPath
         * @return void
         */
        protected function _secure($fullPath)
        {
            /**
             * Validation
             * 
             */

            // grab configuration settings
            $config = \Modules\Images::getConfig();

            // ensure specified path is valid path
            if (!is_file($fullPath)) {

                // error out
                throw new \Exception(
                    'Path *' . ($fullPath) . '* is not a valid resource.'
                );
            }

            // ensure specified path is valid type
            $mime = mime_content_type($fullPath);
            if (!in_array($mime, $config['mimes'])) {

                // error out
                throw new \Exception(
                    'Path *' . ($fullPath) . '* is an unsupported mime type.'
                );
            }
        }

        /**
         * _writable
         * 
         * @access protected
         * @param  string $path
         * @return void
         */
        protected function _writable($path)
        {
            // ensure webroot is writable
            if (!is_writable($path)) {

                // ensure writable to create upload directory
                throw new \Exception(
                    '*' . ($path) . '* must be writable.'
                );
            }
        }

        /**
         * actionFit
         * 
         * @access public
         * @param  integer $width
         * @param  integer $height
         * @return void
         */
        public function actionFit($width, $height)
        {
            // the routing-system casts everything as a string; cast as int
            $width = (int) $width;
            $height = (int) $height;
            $dimensions = ($width) . 'x' . ($height);

            // path and effect setup
            $path = $this->_encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);
            $effect = $this->_encode($_GET['effect']);

            // ensure valid effect
            if (!empty($effect)) {
                if (in_array($effect, $this->_effects) === false) {
                    throw new \Exception('Invalid effect *' . ($effect) . '*');
                }
            }

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
                    ($full) . '*. See module config file.'
                );
            }

            /**
             * Resize (to fit)
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
            if (!empty($effect)) {
                $formatted .= ($effect) . '.';
            }
            $formatted .= $info['extension'];

            // ensure writable
            $this->_writable($info['dirname'] . '/');

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
                $blob
            );

            /**
             * Effect
             * 
             */
            if (!empty($effect)) {

                // set the effect
                $image = (new \ImageEffects\Image(
                    ($info['dirname']) . '/' . ($formatted))
                );
                $blob = $image->$effect();
                unset($image);

                // write it to storage again
                file_put_contents(
                    ($info['dirname']) . '/' . ($formatted),
                    $blob
                );
            }

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('response', $blob);
        }

        /**
         * actionMax
         * 
         * @access public
         * @param  integer $max
         * @return void
         */
        public function actionMax($max)
        {
            // path and effect setup
            $path = $this->_encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);
            $effect = $this->_encode($_GET['effect']);

            // ensure valid effect
            if (!empty($effect)) {
                if (in_array($effect, $this->_effects) === false) {
                    throw new \Exception('Invalid effect *' . ($effect) . '*');
                }
            }

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
                !in_array($max, $config['sizes']['max'])
                && !in_array('*', $config['sizes']['max'])
            ) {
                // error out
                throw new \Exception(
                    'Invalid pixels specified for <max> call on path *' .
                    ($full) . '*. See module config file.'
                );
            }

            /**
             * Resize (to the maximum)
             *
             */

            // create instance; resize it; free memory
            $image = (new \Image($full));
            $blob = $image->max($max);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.max-' . ($max) . '.';
            if (!empty($effect)) {
                $formatted .= ($effect) . '.';
            }
            $formatted .= $info['extension'];

            // ensure writable
            $this->_writable($info['dirname'] . '/');

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
                $blob
            );

            /**
             * Effect
             * 
             */
            if (!empty($effect)) {

                // set the effect
                $image = (new \ImageEffects\Image(
                    ($info['dirname']) . '/' . ($formatted))
                );
                $blob = $image->$effect();
                unset($image);

                // write it to storage again
                file_put_contents(
                    ($info['dirname']) . '/' . ($formatted),
                    $blob
                );
            }

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('response', $blob);
        }

        /**
         * actionMin
         * 
         * @access public
         * @param  integer $min
         * @return void
         */
        public function actionMin($min)
        {
            // path and effect setup
            $path = $this->_encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);
            $effect = $this->_encode($_GET['effect']);

            // ensure valid effect
            if (!empty($effect)) {
                if (in_array($effect, $this->_effects) === false) {
                    throw new \Exception('Invalid effect *' . ($effect) . '*');
                }
            }

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
                !in_array($min, $config['sizes']['min'])
                && !in_array('*', $config['sizes']['min'])
            ) {
                // error out
                throw new \Exception(
                    'Invalid pixels specified for <min> call on path *' .
                    ($full) . '*. See module config file.'
                );
            }

            /**
             * Resize (to the minimum)
             *
             */

            // create instance; resize it; free memory
            $image = (new \Image($full));
            $blob = $image->min($min);
            unset($image);

            /**
             * Storage
             *
             */

            // format name (for storage)
            $info = pathinfo($full);
            $name = $info['filename'];
            $formatted = ($name) . '.min-' . ($min) . '.';
            if (!empty($effect)) {
                $formatted .= ($effect) . '.';
            }
            $formatted .= $info['extension'];

            // ensure writable
            $this->_writable($info['dirname'] . '/');

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
                $blob
            );

            /**
             * Effect
             * 
             */
            if (!empty($effect)) {

                // set the effect
                $image = (new \ImageEffects\Image(
                    ($info['dirname']) . '/' . ($formatted))
                );
                $blob = $image->$effect();
                unset($image);

                // write it to storage again
                file_put_contents(
                    ($info['dirname']) . '/' . ($formatted),
                    $blob
                );
            }

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('response', $blob);
        }

        /**
         * actionSquare
         * 
         * @access public
         * @param  integer $pixels
         * @return void
         */
        public function actionSquare($pixels)
        {
            // path and effect setup
            $path = $this->_encode($_GET['path']);
            $full = (APP) . '/webroot' . ($path);
            $effect = $this->_encode($_GET['effect']);

            // ensure valid effect
            if (!empty($effect)) {
                if (in_array($effect, $this->_effects) === false) {
                    throw new \Exception('Invalid effect *' . ($effect) . '*');
                }
            }

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
                    ($full) . '*. See module config file.'
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
            if (!empty($effect)) {
                $formatted .= ($effect) . '.';
            }
            $formatted .= $info['extension'];

            // ensure writable
            $this->_writable($info['dirname'] . '/');

            // write it to storage
            file_put_contents(
                ($info['dirname']) . '/' . ($formatted),
                $blob
            );

            /**
             * Effect
             * 
             */
            if (!empty($effect)) {

                // set the effect
                $image = (new \ImageEffects\Image(
                    ($info['dirname']) . '/' . ($formatted))
                );
                $blob = $image->$effect();
                unset($image);

                // write it to storage again
                file_put_contents(
                    ($info['dirname']) . '/' . ($formatted),
                    $blob
                );
            }

            /**
             * Serve
             *
             */

            // set request header
            header('Content-Type: ' . ($mime));
            $this->_pass('response', $blob);
        }
    }
