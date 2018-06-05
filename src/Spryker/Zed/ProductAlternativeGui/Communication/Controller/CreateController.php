<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductAlternativeGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\ProductAlternativeGui\Communication\ProductAlternativeGuiCommunicationFactory getFactory()
 */
class CreateController extends AbstractController
{
    protected const FIELD_PRODUCT_NAME_OR_SKU_AUTOCOMPLETE = 'product-name-or-sku-autocomplete';

    protected const MESSAGE_PRODUCT_ALTERNATIVE_CREATE_SUCCESS = 'Product Alternative has been created.';
    protected const MESSAGE_PRODUCT_ALTERNATIVE_CREATE_ERROR = 'Product Alternative has not been created.';

    /**
     * TODO: Rework or delete.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $searchText = $request->query->get(static::FIELD_PRODUCT_NAME_OR_SKU_AUTOCOMPLETE);

        /**
         * TODO: It's okay that code below has an error; this controller might not needed.
         */

        /** @var \Generated\Shared\Transfer\ProductAlternativeResponseTransfer $productAlternativeResponseTransfer */
        $productAlternativeResponseTransfer = $this
            ->getFactory()
            ->getProductAlternativeFacade()
            ->createProductAlternative($searchText);

        if ($productAlternativeResponseTransfer->getIsSuccessful()) {
            $this->addSuccessMessage(static::MESSAGE_PRODUCT_ALTERNATIVE_CREATE_SUCCESS);

            return [
                'productAlternative' => $productAlternativeResponseTransfer
                    ->getProductAlternative()
                    ->toArray(),
            ];
        }

        $this->addErrorMessage(static::MESSAGE_PRODUCT_ALTERNATIVE_CREATE_ERROR);

        return [];
    }
}
