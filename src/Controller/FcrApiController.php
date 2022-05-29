<?php

namespace Evrinoma\FcrBundle\Controller;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrCannotBeSavedException;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Manager\CommandManagerInterface;
use Evrinoma\FcrBundle\Manager\QueryManagerInterface;
use Evrinoma\FcrBundle\PreValidator\DtoPreValidator;
use Evrinoma\UtilsBundle\Controller\AbstractApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class FcrApiController extends AbstractApiController implements ApiControllerInterface
{
//region SECTION: Fields
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface|RestInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface|RestInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;
    /**
     * @var DtoPreValidator
     */
    private DtoPreValidator $preValidator;
//endregion Fields

//region SECTION: Constructor
    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, FactoryDtoInterface $factoryDto, CommandManagerInterface $commandManager, QueryManagerInterface $queryManager, DtoPreValidator $preValidator, string $dtoClass)
    {
        parent::__construct($serializer);
        $this->request        = $requestStack->getCurrentRequest();
        $this->factoryDto     = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager   = $queryManager;
        $this->dtoClass       = $dtoClass;
        $this->preValidator   = $preValidator;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @Rest\Post("/api/fcr/create", options={"expose"=true}, name="api_fcr_create")
     * @OA\Post(
     *     tags={"fcr"},
     *     description="the method perform create fcr",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\FcrBundle\Dto\FcrApiDto",
     *                  "id":"48",
     *                  "description":"Интертех",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\FcrBundle\Dto\FcrApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="description",type="string"),
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Create fcr")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var FcrApiDtoInterface $fcrApiDto */
        $fcrApiDto      = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $this->commandManager->setRestCreated();
        try {
            $this->preValidator->onPost($fcrApiDto);

            $json = [];
            $em   = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($fcrApiDto, $commandManager, &$json) {
                    $json = $commandManager->post($fcrApiDto);
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_post_fcr')->json(['message' => 'Create fcr', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Put("/api/fcr/save", options={"expose"=true}, name="api_fcr_save")
     * @OA\Put(
     *     tags={"fcr"},
     *     description="the method perform save fcr for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\FcrBundle\Dto\FcrApiDto",
     *                  "active": "b",
     *                  "id":"48",
     *                  "description":"Интертех",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\FcrBundle\Dto\FcrApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="description",type="string"),
     *               @OA\Property(property="active",type="string")
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Save code")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var FcrApiDtoInterface $fcrApiDto */
        $fcrApiDto      = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        try {
            $this->preValidator->onPut($fcrApiDto);

            $json = [];
            $em   = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($fcrApiDto, $commandManager, &$json) {
                    $json = $commandManager->put($fcrApiDto);
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_put_fcr')->json(['message' => 'Save fcr', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Delete("/api/fcr/delete", options={"expose"=true}, name="api_fcr_delete")
     * @OA\Delete(
     *     tags={"fcr"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\FcrBundle\Dto\FcrApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Delete fcr")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var FcrApiDtoInterface $fcrApiDto */
        $fcrApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $commandManager = $this->commandManager;
        $this->commandManager->setRestAccepted();

        try {
            $this->preValidator->onDelete($fcrApiDto);
            $json = [];
            $em   = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($fcrApiDto, $commandManager, &$json) {
                    $commandManager->delete($fcrApiDto);
                    $json = ['OK'];
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->json(['message' => 'Delete fcr', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/fcr/criteria", options={"expose"=true}, name="api_fcr_criteria")
     * @OA\Get(
     *     tags={"fcr"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\FcrBundle\Dto\FcrApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="description",
     *         in="query",
     *         name="description",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return fcr")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var FcrApiDtoInterface $fcrApiDto */
        $fcrApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->criteria($fcrApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_fcr')->json(['message' => 'Get fcr', 'data' => $json], $this->queryManager->getRestStatus());
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @Rest\Get("/api/fcr", options={"expose"=true}, name="api_fcr")
     * @OA\Get(
     *     tags={"fcr"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\FcrBundle\Dto\FcrApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return fcr")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var FcrApiDtoInterface $fcrApiDto */
        $fcrApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->get($fcrApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_fcr')->json(['message' => 'Get fcr', 'data' => $json], $this->queryManager->getRestStatus());
    }

    /**
     * @param RestInterface $manager
     * @param \Exception    $e
     *
     * @return array
     */
    public function setRestStatus(RestInterface $manager, \Exception $e): array
    {
        switch (true) {
            case $e instanceof FcrCannotBeSavedException:
                $manager->setRestNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $manager->setRestConflict();
                break;
            case $e instanceof FcrNotFoundException:
                $manager->setRestNotFound();
                break;
            case $e instanceof FcrInvalidException:
                $manager->setRestUnprocessableEntity();
                break;
            default:
                $manager->setRestBadRequest();
        }

        return ['errors' => $e->getMessage()];
    }
//endregion Getters/Setters
}