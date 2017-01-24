<?php

namespace Caxy\EmbeddableWidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WidgetController extends Controller
{
    /**
     * @param string $widgetType
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function embedAction(Request $request, $widgetType)
    {
        $widgets = $this->getParameter('caxy_embeddable_widget.widgets');

        if (!isset($widgets[$widgetType])) {
            throw new NotFoundHttpException(sprintf('Widget type "%s" does not exist.', $widgetType));
        }

        $requestUrl = $request->getSchemeAndHttpHost().$request->getRequestUri();
        $widgetId = 'bmm_widget_'.$widgetType;

        $response = new Response();
        $response->headers->set('Content-Type', 'text/javascript');

        return $this->render(
            'CaxyEmbeddableWidgetBundle:Widget:embed.js.twig',
            [
                'widgetType' => $widgetType,
                'requestUrl' => $requestUrl,
                'widgetId' => $widgetId,
                'widgetHtml' => $widgets[$widgetType]['html'],
                'widgetJs' => isset($widgets[$widgetType]['js']) ? $widgets[$widgetType]['js'] : null,
                'widgetCss' => isset($widgets[$widgetType]['css']) ? $widgets[$widgetType]['css'] : null,
            ],
            $response
        );
    }
}
