<?php

namespace Rest\View;

use Cake\Core\Exception\Exception;
use Cake\View\View;

/**
 * Json View
 *
 * Default view class for rendering API response
 */
class JsonView extends View
{

    /**
     * Renders api response
     *
     * @param string|null $view Name of view file to use
     * @param string|null $layout Layout to use.
     * @return string|null Rendered content or null if content already rendered and returned earlier.
     * @throws Exception If there is an error in the view.
     */
    public function render($view = null, $layout = null)
    {
        if ($this->hasRendered) {
            return null;
        }

        $this->response = $this->response->withType('json');

        $this->layout = "Rest.rest";

        $content = [
            'status' => 'OK'
        ];

        $code = $this->response->getStatusCode();

        if ($code != 200) {
            $content['status'] = "NOK";
        }

        $content['result'] = $this->viewVars;

        $this->Blocks->set('content', $this->renderLayout(json_encode($content), $this->layout));

        $this->hasRendered = true;

        return $this->Blocks->get('content');
    }
}
